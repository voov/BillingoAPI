<?php
/**
 * CSV data import class
 * Written by Zoltan Korosi | webNpro - web development
 * 
 */
class csvData
    {
        private $fp; 
        private $delimiter; 
        private $length; 
        
        function __construct($file_name, $delimiter="\t", $length=8000) 
        { 
            $this->fp = fopen($file_name, "r"); 
            $this->delimiter = $delimiter; 
            $this->length = $length; 
        } 
        
        function __destruct() 
        { 
            if ($this->fp) 
            { 
                fclose($this->fp); 
            } 
        } 
         
        function array_value_recursive($key, array $arr) {
            $val = array();
            array_walk_recursive($arr, function($v, $k) use($key, &$val) {
                if ($k == $key)
                    array_push($val, $v);
            });
            return count($val) > 1 ? $val : array_pop($val);
        }
             
        function get($max_lines=0) 
        { 
            //if $max_lines is set to 0, then get all the data 
            // Arrays we'll use later
            $keys = array();
            $csv_data = array();
            $data = array(); 

            if ($max_lines > 0) 
                $line_count = 0; 
            else 
                $line_count = -1; // so loop limit is ignored 

            $i = 0;
            while ($line_count < $max_lines && ($row = fgetcsv($this->fp, $this->length, $this->delimiter)) !== FALSE) 
            { 
                for ($j = 0; $j < count($row); $j++) {
                                $data[$i][$j] = $row[$j];
                            }
                
                $i++;
                if ($max_lines > 0) 
                    $line_count++; 
            } 
            
            // Set number of elements (minus 1 because we shift off the first row)
            $count = count($data) - 1;

            //Use first row for names
            $labels = array_shift($data);

            foreach ($labels as $label) {
                $keys[] = $label;
            }

            // Bring it all together
            for ($j = 0; $j < $count; $j++) {
                $d = @array_combine($keys, $data[$j]);
                $csv_data[$j] = $d;
            }
            
            return $csv_data; 
        } 
    }