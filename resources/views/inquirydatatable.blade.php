<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>MyCSC@UMS</title>
    <link rel = "icon" href = {{ asset('img/ums_logo.png')}} type = "image/x-icon">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="//unpkg.com/alpinejs" defer></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])


</head>

<body>



    <nav class="custom-navbar navbar navbar-expand-lg navbar-dark">
        <a class="navbar-brand" href="/">
          <img src="/img/mycsc-logo.png" alt="Logo" width="123" height="55">
        </a>
        
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          
          
          <ul class="navbar-nav ml-auto navbar-right-section">
            <li class="nav-item">
              <a class="nav-link" href="/admincreateuser">User</a>
            </li>
    
            <li class="nav-item">
              <a class="nav-link" href="#">Calendar</a>
            </li>
    
            <li class="nav-item">
              <a class="nav-link" href="#">Service</a>
            </li>
    
            <li class="nav-item">
              <a class="nav-link" href="#">Order</a>
            </li>
            
            <li class="nav-item">
              <a class="nav-link" href="#">Invoice</a>
            </li>
    
            <li class="nav-item">
              <a class="nav-link" href="#">Feedback</a>
            </li>
    
            <li class="nav-item">
              <a class="nav-link" href="/inquirydatatable">Inquiry</a>
            </li>
    
            <li class="nav-item">
              <a class="nav-link" href="#">Training</a>
            </li>
            
            <li class="nav-item">
              <a class="nav-link" href="#">News</a>
            </li>
    
            <li class="nav-item">
              <a class="nav-link" href="#">Report</a>
            </li>
    
    
    
            <li class="nav-item dropdown red-rounded-square">
              <a class="nav-link dropdown-toggle" href="#" id="loginDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                
                @if (session('admin'))
                    {{ session('admin')->adminName}}
                @endif  
    
              </a>
              <div class="dropdown-menu" aria-labelledby="loginDropdown">
                <a class="dropdown-item" href="/">My Profile</a>
                <a class="dropdown-item" href="/logout">Logout</a>
                
              </div>
            </li>
          </ul>
        </div>
      </nav>



<div class="inquiry-datatable">
  <div class="table-responsive">  
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>Inquiry ID</th>
                <th>Name</th>
                <th>Message</th>
                <th>Reply</th>
                <th>Email</th>
                <th>Submitted at</th>
                <th>Updated at</th>
                <th>Actions	</th>
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
            <td>{{ $inquiry->created_at ?: '-'}}</td>
            <td>{{ $inquiry->updated_at ?: '-'}}</td>
            <td class="action-icon">
                
                <a  title="View" href="/inquiry/{{$inquiry->inquiryID}}/view"><i class="fas fa-eye"></i></a>
                <a  title="Edit" href="/inquiry/{{$inquiry->inquiryID}}/edit" ><i class="fas fa-edit"></i></a>

                
                    <form method="POST" action="/inquiry/{{ $inquiry->inquiryID }}" onsubmit="return confirmDelete()">
                        @csrf 
                        @method('DELETE')
                        
                        <button style="padding:0; margin:0; background: none; border:none; cursor: pointer" title="Delete"><i class="fas fa-trash"></i></button>
                        
                        </form>
            
                   
            </td>





            
        </tr>
    @endforeach
        </tbody>
    </table>
  </div>
</div>


    <div class="pagination">
    {{ $inquiries->links('pagination::bootstrap-4') }}
    </div>


    <x-flash-message />
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


         // Confirmation dialog for delete
         function confirmDelete() {
            return confirm('Are you sure you want to delete this entry?');
        }

    </script>



    



</body>

</html>
