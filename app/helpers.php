<?php

/**
 * flash a message to the session
 *
 * @param      string  $message  
 */
function flash($message)
{
	session()->flash("flash",$message);
}

function nf()
{
	return number_format(...func_get_args());
}