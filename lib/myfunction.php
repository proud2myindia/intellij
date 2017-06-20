<?php

class Myfunction
{

	public function emailValid($email)
	  {

		// Invalid email address 

        $regex = "^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$^"; 

		if ( preg_match( $regex, $email ) )

           {

			  return true;

			   }

	    else

		 { 

		  return false;

		  }   

	  }

  public function fldempty($value)
	  {
        if(trim(!empty($value)))   //trim-> remove the space after or before value

		{

		    return  true;

			}

		else

		{

			return false;

		}

	  }



    public function check_ph($ph)
    {
        if (ctype_digit($ph) && strlen($ph)==10) {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function check_only_char($only_char)
    {
        if (preg_match('/^[a-zA-Z\s]+$/', $only_char)) {
            return true;
        }
        else
        {
            return false;
        }
    }


 

}