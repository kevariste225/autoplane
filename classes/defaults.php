<?php
	/* Credits & Versions */
	define("Creator",			"Paul Hutchinson",	false);
	define("Copyright",			"Paul Hutchinson 2012",	false);
	define("Licence",		"GNU General Public License",	false); // Take note
	define("Version",			0.66,			false);
	define("ChecksumSalt",			"lfogit66S",		false);

	/* Speed */
	define("SpeedMin",			20,			false);	// MPH
	define("SpeedMax",			80,			false);	// MPH
	define("SpeedCruze",			60,			false);	// MPH

	/* Rotations */
	define("RotationMax",			50,			false);	// Degrees
	define("RotationNormalIncrement",	2,			false);	// Degrees
	define("RotationMaxIncrement",		20,			false);	// Degrees

	/* Polling Speed */
	define("PollRateProxy",			0.3,			false);	// Seconds
	define("PollRateGryo",			5,			false);	// Seconds
	define("PollRateCamera",		1,			false);	// Seconds
	define("PollRateGps",			2,			false);	// Seconds
	define("PollPeers",			5,			false);	// Seconds

	/* Resourse Limits */
	define("RAMMax",			104857600,		false);	// Bytes
	define("CPUMax",			20,			false);	// %
	define("LinuxTopLimit",			2*2,			false);
	define("LogLimit",			104857600,		false); // Bytes
	define("FlightTimeMax",			3600,			false);	// Seconds
	define("CommandTimeout",		360,			false);	// Seconds
	define("BatteryMin",			10,			false); // Percent

	/* SHMOP Allocations for IPC */
	define("SHMOP_CAMERA",			13110,			false); // Camera Daemon
	define("SHMOP_GPS",			13370,			false); // GPS Daemon
	define("SHMOP_GRYO",			13380,			false); // Gryo Daemon
	define("SHMOP_PROX",			13100,			false); // Proximity Daemon
	define("SHMOP_TRASH",			13390,			false); // Other Comunications
	define("SHMOP_SALT",			(int)rand(0, 65000),	false); // Store it somewhere new

	/* Prevent overkill */
	$GLOBALS["rotatingLogs"] = false;

	/* Output mode */
	$GLOBALS["cli"] = php_sapi_name() == "cli";

	/* Counters */
	$GLOBALS["totalMessageCounter"] = 0;
?>
