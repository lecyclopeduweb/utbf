<?php

declare (strict_types = 1);

namespace AppUtbf\CSV;

/**
 * CSV
 *
 * @author     "Jonathan ALCARAS" <lecyclopeduweb@gmail.com>
 */
class CSV
{

    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Create CVS
     *
     * @param array $header  Header CSV
     * @param array $items   List of Row
     * @param string $title  title of CSV
     *
     * @return array
     */
    public function create($header, $items, $title) {


        $temp_file = tmpfile();

        // Check if the temporary file was created successfully
        if ($temp_file !== false) :

            //header
            fputcsv($temp_file, $header);

            // Loop through the data and write it to the CSV file
            foreach ($items as $row) :
                fputcsv($temp_file, $row);// Write each line to the file
            endforeach;

            // Go back to the beginning of the file to be able to read it
            fseek($temp_file, 0);

            // Read the contents of the file and convert it to a string
            $csv_content = stream_get_contents($temp_file);

            // Close the temporary file (it will be deleted automatically)
            fclose($temp_file);

            // Save the CSV content to a physical temporary file on the server
            $csv_filename = 'export_' . time() . '.csv';
            $file_path = wp_upload_dir()['path'] . '/' . $csv_filename;

            // Save the content to a file on the server
            file_put_contents($file_path, $csv_content);

            return [
                'file_url' => wp_upload_dir()['url'] . '/' . $csv_filename,
                'title_cvs' => $title,
            ];


        else:

           return ['message' =>  __('Error creating CSV.', UTBF_TEXT_DOMAIN)];

        endif;
    }

}

