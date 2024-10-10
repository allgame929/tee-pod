<?php

/**
 * The template for Example used in Widget Elementor
 * Author: Dicky Saputra, Andigusta, M.Rizki9591
 *
 * @package HelloElementor
 */

if (!defined('ABSPATH')) {
  exit;
}

class ClientsSliderWidget extends \Elementor\Widget_Base
{
  public function get_name()
  {
    // change this
    return "clients-slider-widget";
  }

  public function get_title()
  {
    // change this
    return __("Clients Slider Widget", THEME_DOMAIN);
  }

  public function get_keywords()
  {
    return ['cew'];
  }

  public function get_icon()
  {
    // change this
    return "eicon-posts-grid";
  }

  public function get_script_depends()
  {
    return ["mi_scripts"];
  }

  public function get_style_depends()
  {
    return ["mi_styles"];
  }

  public function get_categories()
  {
    return ["my-widgets"];
  }

  protected function register_controls()
  {
    // change this
    $this->start_controls_section(
      "content",
      [
        "label" => __("Content", THEME_DOMAIN),
      ]
    );

    // Add gallery control
    $this->add_control(
      'image_gallery',
      [
        'label' => __('Add Images', THEME_DOMAIN),
        'type' => \Elementor\Controls_Manager::GALLERY,
        'default' => [],
      ]
    );

    $this->end_controls_section();
  }

  protected function render()
  {
    $settings = $this->get_settings_for_display();
    require __DIR__ . '/clients-slider-render.php';
  }
}
