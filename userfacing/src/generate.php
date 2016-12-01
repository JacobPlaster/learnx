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
                "Using new stream to reach out to my fans!!!! Hellooo."];
$tags = ['cssfg', 'sdsfdft', 'ddgfhaad'. 'yerxg234', '213dttvv', 'myfirststream', 'leagueoflegends', 'grad_cam_1', 'cam_2',
          'cam_4', 'dfgdgfh', '32afvdf4', '3sf46fg', '3sxcjuhjh', 'oyptdfy', '232xcd65', 'sadddsxxv', '3sfd454s', '566ggdd5'];


// generate users]
for ($i = 0; $i < count($users); $i++) {
  $data['username'] = $users[$i];
  $data['password'] = $passwords[$i];
  $data['email'] = $users[$i]."@gmail.com";
  addUser($data);
}


$UserIDs = $dm->getAllUserIDs();
//print_r($UserIDs);
// generate video streams
for ($i = 0; $i < count($tags); $i++) {
    $data2['tag'] = $tags[$i];
    // pick random user to own stream
    $data2['user_id'] = $UserIDs[rand(0, count($UserIDs)-1)]['id'];
    // pick random title
    $data2['title'] = $titles[rand(0, count($titles)-1)];
    // pick random description
    $data2['description'] = $descriptions[rand(0, count($descriptions)-1)];
    // generate stream key
    $data2['stream_key'] = randStrGen(10);
    addVideoStream($data2);
    addChatStream($data2);
}

function addVideoStream($data)
{
  global $dm;
  if($dm->videoStreamTagExists($data['tag']) == NULL)
    $dm->addNewVideoStream($data['user_id'], $data['tag'], $data['title'], $data['description'], $data['stream_key']);
}
function addChatStream($data)
{
  global $dm;
  if($dm->chatStreamTagExists($data['tag']) == NULL)
    $dm->addNewChatStream($data['user_id'], $data['tag']);
}

function addUser($data)
{
  global $dm;
  if($dm->usernameExists($data['username']) == NULL)
    $dm->addNewUser($data['username'], $data['password'], $data['email']);
}

// generate randowm string
function randStrGen($len){
    $result = "";
    $chars = "abcdefghijklmnopqrstuvwxyz$_?!-0123456789";
    $charArray = str_split($chars);
    for($i = 0; $i < $len; $i++){
	    $randItem = array_rand($charArray);
	    $result .= "".$charArray[$randItem];
    }
    return $result;
}



?>
