<?php

namespace application\controllers;

interface IController {
	public function dispatch();
	public function render();
	public function getViewFolder();
}