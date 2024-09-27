<?php
function greet($name, $color)
{
  echo "<p>Hi, My name is $name and my favorite color is $color </p>";
}
greet('john', 'green');
greet('Jane', 'blue');
?>
<h1><?php bloginfo('name');
    ?></h1>
<p><?php bloginfo('description'); ?></p>
<?php ?>