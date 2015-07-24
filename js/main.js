// The root URL for the RESTful services
var rootAccomplishmentURL = "http://localhost/effres/api/accomplishment";

var currentWine;

// Nothing to delete in initial application state
$('#btnDelete').hide();

// Register listeners
$('#btnSearch').click(function() {
	search($('#searchKey').val());
	return false;
});

// Trigger search when pressing 'Return' on search key input field
$('#searchKey').keypress(function(e){
	if(e.which == 13) {
		search($('#searchKey').val());
		e.preventDefault();
		return false;
    }
});

$('#btnAdd').click(function() {
	newWine();
	return false;
});

$('#btnSave').click(function() {
	addWine();
	return false;
});

$('#btnDelete').click(function() {
	addWine();
	return false;
});

$('#wineList a').live('click', function() {
	findById($(this).data('identity'));
});

// Replace broken images with generic wine bottle
$("img").error(function(){
  $(this).attr("src", "pics/generic.jpg");

});

function search(searchKey) {
	if (searchKey == '') 
		findAll();
	else
		findByName(searchKey);
}

function newWine() {
	$('#btnDelete').hide();
	currentWine = {};
	renderDetails(currentWine); // Display empty form
}

function findAll() {
	console.log('findAll');
	$.ajax({
		type: 'GET',
		url: rootURL,
		dataType: "json", // data type of response
		success: renderList
	});
}

function findByName(searchKey) {
	console.log('findByName: ' + searchKey);
	$.ajax({
		type: 'GET',
		url: rootURL + '/search/' + searchKey,
		dataType: "json",
		success: renderList 
	});
}

function findById(id) {
	console.log('findById: ' + id);
	$.ajax({
		type: 'GET',
		url: rootURL + '/' + id,
		dataType: "json",
		success: function(data){
			$('#btnDelete').show();
			console.log('findById success: ' + data.name);
			currentWine = data;
			renderDetails(currentWine);
		}
	});
}

function addWine() {
	console.log('addWine');
	$.ajax({
		type: 'POST',
		contentType: 'application/json',
		url: rootAccomplishmentURL,
		dataType: "json",
		data: formToJSON(),
		success: function(data, textStatus, jqXHR){
			alert('Project created successfully');
			$('#btnDelete').show();
			$('#wineId').val(data.id);
		},
		error: function(jqXHR, textStatus, errorThrown){
			alert('addWine error: ' + textStatus);
		}
	});
}

function updateWine() {
	console.log('updateWine');
	$.ajax({
		type: 'PUT',
		contentType: 'application/json',
		url: rootURL + '/' + $('#wineId').val(),
		dataType: "json",
		data: formToJSON(),
		success: function(data, textStatus, jqXHR){
			alert('Wine updated successfully');
		},
		error: function(jqXHR, textStatus, errorThrown){
			alert('updateWine error: ' + textStatus);
		}
	});
}

function deleteWine() {
	console.log('deleteWine');
	$.ajax({
		type: 'DELETE',
		url: rootURL + '/' + $('#wineId').val(),
		success: function(data, textStatus, jqXHR){
			alert('Wine deleted successfully');
		},
		error: function(jqXHR, textStatus, errorThrown){
			alert('deleteWine error');
		}
	});
}

function renderList(data) {
	// JAX-RS serializes an empty list as null, and a 'collection of one' as an object (not an 'array of one')
	var list = data == null ? [] : (data.wine instanceof Array ? data.wine : [data.wine]);

	$('#wineList li').remove();
	$.each(list, function(index, wine) {
		$('#wineList').append('<li><a href="#" data-identity="' + wine.id + '">'+wine.name+'</a></li>');
	});
}

function renderDetails(wine) {
	$('#user_id').val(wine.id);
	$('#project_id').val(wine.name);
	$('#company_id').val(wine.grapes);
	$('#impact_type_id').val(wine.country);
	$('#impact_value').val(wine.region);
	$('#project_description').val(wine.year);
	$('#pic').attr('src', 'pics/' + wine.picture);
	$('#description').val(wine.description);
}

// Helper function to serialize all the form fields into a JSON string
function formToJSON() {
	var AccJ =  JSON.stringify({
		"user_id": 1, 
		"company_id": 2,
		"accomplishment_desc": $('#accomplishment_desc').val()
		});
	console.log(AccJ);
	return AccJ;
}
