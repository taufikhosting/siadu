<?php
header('Content-type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
header('Content-Disposition: attachment; filename="yourfile.docx"');
readfile('myfile.docx');
?>