<?php

function folderManager()
{
    return app('Nonocompany\MediaManager\Foundation\FolderManager');
}

function fileUploader()
{
    return app('Nonocompany\MediaManager\Foundation\FileUploader');
}


function fileManager()
{
    return app('Nonocompany\MediaManager\Foundation\FileManager');
}
