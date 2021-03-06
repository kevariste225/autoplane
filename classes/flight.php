<?php
	// Flight Management class
	class Flight extends Log {
		private $name = false;
		private $description = false;
		private $waypoints = array();
		private $point = 0;

		function __construct ($kml = false) {
			parent::__construct("Flight");
			$this->loadFlight($kml);
		}

		public function reset () {
			$this->name = false;
			$this->description = false;
			$this->waypoints = array();
			$this->point = 0;
			return true;
		}

		public function loadFlight ($kml = false) {
			if (!is_object($kml)) {
				if ($kml === false) {
					$this->log("Data invalid", 1);
				}
				return false;
			}

			$this->tab(1);

			// Set Meta
			$this->waypoints = array();
			$this->setName((string)$kml->Document->name);
			$this->setDescription((string)$kml->Document->description);

			// Convert the string of coords to an array
			$points = explode(PHP_EOL, $kml->Document->Placemark->LineString->coordinates);
			foreach ($points as &$point) {
				$point = trim($point);
				if (!is_string($point) && strlen($point) < 3) {
					$this->log("Empty point", 0);
					continue;
				}
				$parts = explode(",", $point);
				if (count($parts) != 3) {
					$this->log("Incorrect line string parameters. Line: '{$point}'", 1);
					continue;
				}
				$this->waypoints[] = new GPS ((float)$parts[0], (float)$parts[1], (float)$parts[2]);
			}
			$this->tab(-1);
			return true;
		}

		public function setName ($name = false) {
			if (!is_string($name)) {
				$this->log("Invalid type for name", 1);
				return false;
			}
			$name = trim($name);
			if (strlen($name) === 0) {
				$this->log("Name too short", 2);
				return false;
			}
			$this->log("Flight name set to: {$name}", 0);
			$this->name = trim($name);
			return true;
		}

		public function setDescription ($description = false) {
			if (!is_string($description)) {
				$this->log("Invalid type for description", 1);
				return false;
			}
			$description = trim($description);
			if (strlen($description) === 0) {
				$this->log("Description too short");
				return false;
			}
			$this->description = trim($description);
			return true;
		}

		public function addWaypoint ($gps = false) {
			if (!is_object($gps)) {
				$this->log("Waypoint not GPS location", 1);
				return false;
			}
			if (!is_array($this->waypoints)) {
				$this->waypoints = array();
			}
			$this->waypoints[] = $gps;
			return true;
		}

		public function getPoint ($point = false) {
			if ($point === false) {
				$point = $this->point;
			}
			if (!is_int($point)) {
				$this->log("Invalid datatype for Point", 1);
				return false;
			}
			if (!isset($this->waypoints[$point])) {
				$this->log("Point doesn't exist" ,2);
				return false;
			}
			return $this->waypoints;
		}

		public function getDetails () {
			return array(
				"name"		=> &$this->name,
				"description"	=> &$this->description,
				"waypoints"	=> &$this->waypoints,
				"point"		=> &$this->point
			);
		}
	}
?>
