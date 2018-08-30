# php-capcha
Capcha Creator for PHP

### Usage
 - Just add the Capcha.php file as a src of an image for get the capcha
 - The value of the Capcha will store in `$_SESSION['yt_capcha']`, so you can check if the capcha is currect
 
### Example
```php
<?php
session_start();  # !important

# check if capcha is currect
if(array_key_exists('capcha',$_GET)){
    if (array_key_exists('yt_capcha',$_SESSION) && $_GET['capcha'] === $_SESSION['yt_capcha']){ 
        echo '<p>You are not a robot!</div>';
    }else{
        echo '<p>You are a robot!</div>';
    }
}
?>
<form method="get">
    # setup the capcha
    <img style="display:block" src="Capcha.php"/> 
    <br/>
    <input name="capcha" type="text"/>
    <input type="submit"/>
</form>
```
