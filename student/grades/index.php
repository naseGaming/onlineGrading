<div class = "page_header">
        <select onchange = "getGradeByYear(this);">
            <option value = "">Select a Year</option>
            <?php
                $date = date("Y");

                for($i = $date; $i >= 1990; $i--) {
                    echo "<option>".$i."</option>";
                }
            ?>
        </select>
</div>

<div class = "table_responsive" >
    <table id = "tblGrades" class = "container">
        <thead>
            <tr>
                <th>Subject Description</th>
                <th>First Grading</th>
                <th>Second Grading</th>
                <th>Third Grading</th>
                <th>Fourth Grading</th>
                <th>Final Grade</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>
