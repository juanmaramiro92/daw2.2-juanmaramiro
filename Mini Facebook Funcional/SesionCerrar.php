<?php

require_once "_com/DAO.php";

DAO::destruirSesionRamYCookie();

redireccionar("Index.php");