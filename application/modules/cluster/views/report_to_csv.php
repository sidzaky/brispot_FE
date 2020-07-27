
    <script type="text/javascript">
        // JSON to CSV Converter
        function ConvertToCSV(objArray) {
            var array = typeof objArray != 'object' ? JSON.parse(objArray) : objArray;
            var str = '';

            for (var i = 0; i < array.length; i++) {
                var line = '';
                for (var index in array[i]) {
                    if (line != '') line += ','

                    line += array[i][index];
                }

                str += line + '\r\n';
            }

            return str;
        }

        // Example
        $(document).ready(function () {

            // Create Object
            var items = [
                  { name: "Item 1", color: "Green", size: "X-Large" },
                  { name: "Item 2", color: "Green", size: "X-Large" },
                  { name: "Item 3", color: "Green", size: "X-Large" }];

            // Convert Object to JSON
            var jsonObject = JSON.stringify(items);

            // Display JSON
            $('#json').text(jsonObject);

            // Convert JSON to CSV & Display CSV
            $('#csv').text(ConvertToCSV(jsonObject));
        });
    </script>