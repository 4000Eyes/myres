<?php

function _cleanup_text($text) {

  $text = strip_tags($text);
  //$text = htmlspecialchars_decode($text);
  //$text = preg_replace("/&#?[a-z0-9]{2,8};/i","",$text);

  $RemoveChars[] = "([,.:;!?()#&%+*\"'])";
  $ReplaceWith = " ";
  return $text  = preg_replace($RemoveChars, $ReplaceWith, $text);

}
?>
