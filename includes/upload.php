<?php
$con = mysqli_connect("localhost","root","","temp_anis");
// Check connection
if (mysqli_connect_errno()){
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}



$file_name = basename($_FILES['0xfile']['name']);

// random 4 digit to add to our file name 
// some people use date and time in stead of random digit 
$random_digit=rand(00000000,99999999);

//combine random digit to you file name to create new file name
//use dot (.) to combile these two variables

// check extension
$allowed =  array('gif','png' ,'jpg');
$ext = pathinfo($file_name, PATHINFO_EXTENSION);
$new_file_name=$random_digit.".".$ext; //.$file_name;

//set where you want to store files
//in this example we keep file in folder upload 
//$new_file_name = new upload file name
//for example upload file name cartoon.gif . $path will be upload/cartoon.gif
$path= "../images/".$new_file_name;
if(!in_array($ext,$allowed) ) {
    echo 'Upload only .gif, .png or .jpg file';
}else{
  if ($_FILES['0xfile']['size'] != 0)
  {
    if(copy($_FILES['0xfile']['tmp_name'], $path))
    {
      echo "Successful<BR/>"; 

      //$new_file_name = new file name
      //$HTTP_POST_FILES['ufile']['size'] = file size
      //$HTTP_POST_FILES['ufile']['type'] = type of file
      echo "File Name :".$new_file_name."<BR/>"; 
      echo "File Size :".$_FILES['0xfile']['size']."<BR/>"; 
      echo "File Type :".$_FILES['0xfile']['type']."<BR/>"; 
      echo "File URL  :"."../images/{$new_file_name}";
      $url="../images/{$new_file_name}";
      echo "<br/><img src=\"{$url}\"/><br/>";


       // Perform a query, check for error
      if (!mysqli_query($con,"INSERT INTO upload_img(id,url,exp) VALUES (NULL,'$url',NULL)")){
        echo("Error description: " . mysqli_error($con));
      }
      echo "Successful saved into database";
      mysqli_close($con);

    }else{
      echo "Error";
    }
  }
}

?>