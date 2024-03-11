 <script>
        // JavaScript for dynamic addition and deletion of sub-main locations
        document.addEventListener('DOMContentLoaded', function() {
            const container = document.getElementById('sub-main-locations-container');
            const addButton = document.getElementById('add-sub-main-location');

            addButton.addEventListener('click', function() {
                const row = document.createElement('div');
                row.classList.add('sub-main-location-row', 'row', 'mb-2');

                const inputColumn = document.createElement('div');
                inputColumn.classList.add('col-8');

                const input = document.createElement('input');
                input.type = 'text';
                input.name = 'sub_main_locations_edit[]';
                input.classList.add('form-control');

                inputColumn.appendChild(input);

                const deleteButtonColumn = document.createElement('div');
                deleteButtonColumn.classList.add('col-4');

                const deleteButton = document.createElement('button');
                deleteButton.type = 'button';
                deleteButton.classList.add('btn', 'btn-danger', 'w-100');
                deleteButton.textContent = 'Remove';
                deleteButton.addEventListener('click', function() {
                    container.removeChild(row);
                });

                deleteButtonColumn.appendChild(deleteButton);

                row.appendChild(inputColumn);
                row.appendChild(deleteButtonColumn);

                container.appendChild(row);
            });
        });
    </script>