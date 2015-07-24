drop table effres_user;
create table effres_user
(
user_id int(32) not null auto_increment,
user_name varchar(128) not null,
user_login_name varchar(28) not null,
password char(32) not null,
PRIMARY KEY (`user_id`)
) auto_increment=9000;

drop table user_project_accomplishment;
create table user_project_accomplishment
(
	user_id int(64) not null,
	project_id int(32) not null,
	company_id int(32) not null,
	project_description varchar(128) not null
);

drop table user_project_smart_contribution;
create table user_project_smart_contribution
(
	user_id int(64) not null,
	project_id int(32) not null,
	company_id int(32) not null,
	goal_id int(2) not null,
	impact_description varchar(144) not null
);

drop table user_project_impact_tag;
create table user_project_impact_tag
(
	user_id int(64) not null,
	project_id int(32) not null,
	company_id int(32) not null,
	goal_id int(2) not null,
	tag_id blob	
);

drop table  user_project_friend_referral;
create table  user_project_friend_referral
(
	user_id int(64) not null,
	friend_id int(64) not null,
	project_id int(32) not null,
	is_active int(1),
	last_request_date datetime
);

drop table user_project_friend_referral_feedback;
create table user_project_friend_referral_feedback
(
	user_id int(64) not null,
	friend_id int(64) not null,
	rel_type int(2) not null,
	feedback_response_type int(2) not null
);

drop  table relation_type;
create table relation_type
(
	rel_type int(2) not null,
	rel_type_name varchar(64) not null,
	rel_type_value int(2) not null
);

