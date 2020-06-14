<?php


namespace App\Migrations;



use App\Entity\Image;
use App\Entity\Problem;

class FileReader
{
    private $PATH;
    private $ZDJECIA = "\zdjecia";
    private $TEKSTY = "\\teksty";

    public function __construct()
    {
        $this->PATH = $_SERVER['DOCUMENT_ROOT'] . "\storage";
    }

    private function readFile($path) :string {
        if(file_exists($path)){
//            $file = fopen($path, "r") or die("Unable to open file!");
//            $result = fread($file,filesize($path));
//            fclose($file);
//            return $result;
            return file_get_contents($path);
        }
        else{
            return "an error occured during reading file";
        }
    }
    public function getTestFiles(): array{
        return $this->getFileList($this->PATH);
    }
    private function getFileList($path) : array{
        return scandir($path);
    }
    public function getImages(): array{
        $path = $this->PATH . $this->ZDJECIA;
        $listOfZdjecia = $this->getFileList($path);
        $images = array();
        $size = count($listOfZdjecia);
        for($j=0; $j<$size; $j++) {
            $name = basename($listOfZdjecia[$j]);
            if($name === "." || $name === ".."){
                continue;
            }
            $object = new Image($name, "/files/zdjecia/" . $name);
            $images[] = $object;
        }
        return $images;
    }
    public function getProblems($imageArray): array{
        $pathTxt = $this->PATH . $this->TEKSTY;
        $listOfZdjecia = $imageArray;
        $listOfTeksty = $this->getFileList($pathTxt);
        $size = sizeof($listOfTeksty);
        $problems = array();
        for($i=0; $i<$size; $i++){
            $name = basename($listOfTeksty[$i]);
            if($name === "." || $name === ".."){
                continue;
            }
            $textValue = $this->readFile($pathTxt . "\\" . $name);
            $zdjeciaSize = sizeof($listOfZdjecia);
            for($j=0; $j<$zdjeciaSize; $j++) {
                $zdjecie = $listOfZdjecia[$j];
                $zdjecieName = $zdjecie->getName();
                $nameLength = strlen($zdjecieName);

                $compare2 = str_replace(substr($zdjecieName, strrpos($zdjecieName, ".")), "", $zdjecieName);
                $compare1 = mb_strtolower(substr($textValue, 0, strlen($compare2)), "UTF-8");
                echo "    compare 1 ->  |".$compare1."|  compare 2 -> |".$compare2. "|</br>";
                //if(str_starts_with($compare1, $compare2)){
                if(strcasecmp($compare1, $compare2) == 0){
                    echo "!!!WSZEDLEM!!!";
                    $object = new Problem();
                    $object->setName($zdjecieName);
                    $object->setDescription($textValue);
                    $object->setImage($zdjecie);
                    $object->setUrlPath(
                        "/problem/" . $zdjecieName);
                    $problems[] =$object;
                    $listOfZdjecia[$j] = new Image("ASdasd.kpg", "Asdasd");
                    break;
                }
            }

        }
        //echo sizeof($problems);
        return $problems;
    }

    private function generateUrlPath($zdjecieName):string
    {
        $name = strtolower($zdjecieName);
        str_replace("ł", "l", $name);
        str_replace("ó", "o", $name);
        str_replace("ą", "a", $name);
        str_replace("ę", "e", $name);
        str_replace("ż", "z", $name);
        str_replace("ź", "z", $name);
        str_replace("ń", "n", $name);
        str_replace("ć", "c", $name);
        str_replace("ś", "s", $name);
        str_replace(" ", "-", $name);
        preg_replace('/[^A-Za-z0-9\-]/', '', $name);
        return $name;
    }
}