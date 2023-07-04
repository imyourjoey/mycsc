<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<body>
  <div class="table-responsive">  
    <table id="myTable" class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>Inquiry ID</th>
                <th>Name</th>
                <th>Message</th>
                <th>Reply</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($inquiries as $inquiry)
        <tr>
            <td>{{ $inquiry->inquiryID ?: '-'}}</td>
            <td>{{ $inquiry->inquiryName ?: '-'}}</td>
            <td>{{ $inquiry->inquiryMessage ?: '-'}}</td>
            <td>{{ $inquiry->inquiryReply ?: '-'}}</td>
            <td>{{ $inquiry->inquiryContactEmail ?: '-'}}</td>
            <td><a  title="View"><i class="fas fa-eye"></i></a>
                <a  title="Edit"><i class="fas fa-edit"></i></a>

                <form method="POST"action="/inquiry/{{ $inquiry->inquiryID }}">
                @csrf
                @method('DELETE')
                
                <button title="Delete"><i class="fas fa-trash"></i></button>
                
                </form>
                
            </td>





            
        </tr>
    @endforeach
        </tbody>
    </table>
  </div>


  <div class="pagination">
    {{ $inquiries->links('pagination::bootstrap-4') }}
</div>



    <script>
        const table = document.getElementById('myTable');
        const headers = table.querySelectorAll('th');
        const rows = table.querySelectorAll('tbody tr');

        // Add event listeners to enable sorting on table headers
        headers.forEach(header => {
            header.addEventListener('click', () => {
                const index = Array.from(headers).indexOf(header);
                const isAscending = header.classList.contains('ascending');
                sortTable(index, !isAscending);
            });
        });

        // Function to sort the table based on the given column index and order
        function sortTable(columnIndex, ascending) {
            const tbody = table.querySelector('tbody');
            const rowsArray = Array.from(rows);

            rowsArray.sort((rowA, rowB) => {
                const cellA = rowA.querySelectorAll('td')[columnIndex].innerText;
                const cellB = rowB.querySelectorAll('td')[columnIndex].innerText;

                return ascending ? cellA.localeCompare(cellB) : cellB.localeCompare(cellA);
            });

            tbody.innerHTML = '';
            rowsArray.forEach(row => tbody.appendChild(row));

            // Remove existing sorting classes from headers
            headers.forEach(header => header.classList.remove('ascending', 'descending'));

            // Add sorting class to the selected header
            headers[columnIndex].classList.add(ascending ? 'ascending' : 'descending');
        }

    </script>


</body>

</html>
