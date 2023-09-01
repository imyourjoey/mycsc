<x-layout>

  <h1>Yoooooooooooooooooooo</h1>


  <table id="myDataTable" class="display">
    <thead>
        <tr>
            <th>Name</th>
            <th>Age</th>
            <th>City</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>John Doe</td>
            <td>25</td>
            <td>New York</td>
        </tr>
        <!-- More rows... -->
    </tbody>
</table>





  
</x-layout>

<script>
    $(document).ready(function() {
        $('#myDataTable').DataTable({
            paging: true,      // Enable pagination
            searching: true,   // Enable search box
            ordering: true     // Enable sorting
            // More options...
        });
    });
  
    
  </script>