<?php





    $file_content = $filesystem->read($todo->path);
    file_put_contents(__DIR__ . '/tmp/' . $todo->basename, $file_content);
    $zip = new ZipArchive;
    $res = $zip->open(__DIR__ . '/tmp/' . $todo->basename);

    if ($res === true) {
        $zip->extractTo(__DIR__ . '/tmp/' . basename($todo->basename, '.zip'));
        $zip->close();
        // to check base name
        // dump(basename($todo->basename, '.zip'));
        // file get content
        $contents = file_get_contents(__DIR__ . '/tmp/' . basename($todo->basename, '.zip')
            . '/' . basename($todo->basename, '.zip') . '.xml');
        //dump(simplexml_load_string($contents));
        $att = simplexml_load_string($contents)->attributes();
        // convert to array the object
        $array = (array)$att['type'];
        
        //if($array[0]=="BIL"||$array[0]=="ACT"||$array[0]=="RCS")
        //check if type is "BIL" or "ACT" or "RCS"
        if ($array[0] == "RCS") {
            dump($array[0]);
            dump($todo->path);
            die();
        }
    }
