<?php

class WorkflowFileEnTranslator{
    public static function initData()
    {
        $trad = [];

		$trad["workflow_file"]["workflowfile.single"] = "File";
		$trad["workflow_file"]["workflowfile.new"] = "new";
		$trad["workflow_file"]["workflow_file"] = "Files";
        $trad["workflow_file"]["doc_type_id"] = "File type";
		$trad["workflow_file"]["afile_date"] = "File upload date";
		$trad["workflow_file"]["afile_time"] = "File upload time";
		$trad["workflow_file"]["afile_name"] = "File name";
		$trad["workflow_file"]["is_ok"] = "Data is ok";
        // steps
        return $trad;
    }

    public static function getInstance()
	{
		return new WorkflowFile();
	}
}