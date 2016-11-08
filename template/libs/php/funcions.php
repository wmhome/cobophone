<?php
//VARS
$cobophone_alojamiento='db647078095.db.1and1.com';
$cobophone_user='dbo647078095';
$cobophone_pass='.Mimosa1130';
$cobophone_db='db647078095';
function conecta(){
	$link=mysql_connect('db647078095.db.1and1.com', 'dbo647078095', '.Mimosa1130');
	mysql_select_db('db647078095', $link);
	return $link;	
}
function busqueda($sql, $link){
	$link=conecta();
	$result=@mysql_query($sql, $link);
	return $result;
}
function recibir_array($result){
	$link=conecta();
	$row=@mysql_fetch_array($result);
	return $row;
}
function recortar($txt){
	$Texto=$txt;
	$MaxLENGTH=150;
	$TextoResumen = substr($Texto,0,strrpos(substr($Texto,0,$MaxLENGTH)," "));
	return $TextoResumen."...";
}