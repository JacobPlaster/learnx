<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/cfg.php');
require_once($SERVER_PATH['libs-php'].'/DatabaseManager.php');

// Update database and connect
$dm = new DatabaseManager;
$conn = $dm->connect();


$users = ["Jacob", "Admin", "Yaqub", "Dave232", "THomster24", "Sir_Clownz", "MrGrathen", "Am_Dirty",
          "musclemayoan", "ChampChong", "root", "conor747", "Thornster321", "Markell8743", "WockaWocka", "a"];
$passwords = $users;

$titles = ["Lorem ipsum title", "Australian Adventure - Pokemon Go", "Cooking time - roast dinner",
            "League of legends - TSM", "Graduation - Hull University", "Graduation - Berlin University",
            "Graduation - London University", "Building a custom pc", "Live with PC mag", "Live with countryfile mag"];
$descriptions = ["Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s",
                "when an unknown printer took a galley of type and scrambled it to make a type specimen book.",
                "It has survived not only five centuries, but also the leap into electronic typesetting.",
                "Using new stream to reach out to my fans!!!! Hellooo."]
$tags = ['cssfg', 'sdsfdft', 'ddgfhaad'. 'yerxg234', '213dttvv', 'myfirststream', 'leagueoflegends', 'grad_cam_1', 'cam_2',
          'cam_4', 'dfgdgfh', '32afvdf4', '3sf46fg', '3sxcjuhjh', 'oyptdfy', '232xcd65', 'sadddsxxv', '3sfd454s', '566ggdd5']

function addVideoStream($data)
{
}
function addChatStream($StreamKey)
{
}
function addUser($StreamKey)
{
}

?>
