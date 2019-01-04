<?php
function os2bootstrap_menu_tree(&$variables) {
  return '<div class="nav menu content-menu"><ul class="menu nav nav-pills nav-stacked content-menu">' . $variables['tree'] . '</ul></div>'; // added the nav-collapse wrapper so you can hide the nav at small size
}
function os2bootstrap_menu_link(array $variables) {
  $element = $variables['element'];
  $sub_menu = '';
    if ($element['#below']) {
    // Ad our own wrapper
    unset($element['#below']['#theme_wrappers']);
    $sub_menu = '<ul class="menu expanded nav nav-pills nav-stacked">' . drupal_render($element['#below']) . '</ul>'; // removed flyout class in ul
    // unset($element['#localized_options']['attributes']['class']); // removed flydown class
    unset($element['#localized_options']['attributes']['data-toggle']); // removed data toggler
    // Check if this element is nested within another
    if ((!empty($element['#original_link']['depth'])) && ($element['#original_link']['depth'] > 1)) {
    //  unset($element['#attributes']['class']); // removed flyout class
    }
    else {
     // unset($element['#attributes']['class']); // unset flyout class
      $element['#localized_options']['html'] = TRUE;
      $element['#title'] .= ''; // removed carat spans flyout
    }
    // Set dropdown trigger element to # to prevent inadvertent page loading with submenu click
    $element['#localized_options']['attributes']['data-target'] = '#'; // You could unset this too as its no longer necessary.
  }
  $output = l($element['#title'], $element['#href'], $element['#localized_options']);
  return '<li' . drupal_attributes($element['#attributes']) . '>' . $output . $sub_menu . "</li>\n";
}
?>