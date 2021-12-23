<?php
// Git: https://github.com/crewnew/gspreadsheet-to-ats
// FC: public_html/crewnew.com/projects/crewnew/gspreadsheet-to-ats
// URL: https://projects.crewnew.com/crewnew/gspreadsheet-to-ats/

$spreadsheet_url = "https://docs.google.com/spreadsheets/d/e/2PACX-1vSXJ8gKEukzIfWlDDujG9wga9X6MryH7fRZqE5Yxng6D60PKWD1CZLIFUvgQAoVk3ro_cxesrp7bo4A/pub?gid=0&single=true&output=csv";

if (!ini_set('default_socket_timeout', 15)) echo "unable to change socket timeout";

$i = 0; //just to skip the first line in the CSV

echo '<h2>Google Spreadsheet -> ATS (GraphQL)</h2>';
echo '<table><tr><th>No</th><th>Project ID</th><th>Name</th><th>Title</th><th>Company</th></tr>';

$no = 1;

if (($handle = fopen($spreadsheet_url, "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        if ($i > 0) { //skip the first line
            $project_id = $data[0];
            $first_name = $data[1];
            $last_name = $data[2];
            $title = $data[3];
            $company = $data[4];

            echo '<tr><td>' . $no . '</td><td>' . $project_id . '</td><td>' . $first_name . ' ' . $last_name . '</td><td>' . $title . '</td><td>' . $company . '</td></tr>';
            $no++;
        } //end: skip the first line
        $i++;
    }
    fclose($handle);
} else
    die("Problem reading csv");
$conn->close();
