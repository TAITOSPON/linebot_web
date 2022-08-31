<!-- "https://memberapp.toat.co.th/memberttm/" -->
<!DOCTYPE html>
<html>
<head>
<title>TOAT | <?php echo $title; ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>


.responsive-iframe {
  position: absolute;
  top: 0;
  left: 0;
  bottom: 0;
  right: 0;
  width: 100%;
  height: 100%;
  border: none;
}
</style>
</head>
<body>


<div class="container"> 
  <iframe class="responsive-iframe" src="<?php echo $site_url; ?>"></iframe>
</div>

</body>
</html>
