<?php

require_once "_com/DAO.php";

if ($_REQUEST["destinatarioId"] == -1) $destinatarioId = null;
else $destinatarioId = $_REQUEST["destinatarioId"];

DAO::nuevaPublicacion($destinatarioId, $_REQUEST["asunto"], $_REQUEST["contenido"]);

redireccionar(getenv('HTTP_REFERER'));