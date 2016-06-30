<?php
include '../../configs.php';
include '../../db.php';

$sql = "";


if (!empty($_GET)) {
	switch ($_GET['command']) {
		case 'add':
			if (empty($_GET['song_id'])) {
				//song_id not given so do nothing
				die("Missing parameter: song_id");
			}

			$sql = "INSERT IGNORE INTO fav (status, singer, singerLen, songName, songNameLen, song_id, dirpath) SELECT 'N', singer, char_length(singer), songName, char_length(songName), id, dirpath FROM songs WHERE id = " . $_GET['song_id'] . " ON DUPLICATE KEY UPDATE status = 'N'";

			break;
		case 'delete':
			if (empty($_GET['song_id'])) {
				//song_id not given so do nothing
				die("Missing parameter: song_id");
			}
			
			$sql = "DELETE FROM fav WHERE song_id = " . $_GET['song_id'];
			break;
		default:
			// error
			printf("command not given: add or delete");
			return;
	}
}

header('Content-Type: application/json; charset=utf-8');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers", "Origin, X-Requested-With, Content-Type, Accept");

echo $sql;
echo (String) execute_query($sql);

?>