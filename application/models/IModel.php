<?php
namespace application\models;

interface IModel {
	public function __call($name, $args);
	public function __toString();
	public static function renderForControl();
}