<style>
    .modal-dialog-slideout {
        min-height: 100%;
        max-width: 28%;
        margin: 0 0 0 auto;
        background: #fff;
    }

    .modal.fade .modal-dialog.modal-dialog-slideout {
        -webkit-transform: translate(100%, 0)scale(1);
        transform: translate(100%, 0)scale(1);
    }

    .modal.fade.show .modal-dialog.modal-dialog-slideout {
        -webkit-transform: translate(0, 0);
        transform: translate(0, 0);
        display: flex;
        align-items: stretch;
        -webkit-box-align: stretch;
        height: 100%;
    }

    .modal.fade.show .modal-dialog.modal-dialog-slideout .modal-body {
        overflow-y: auto;
        overflow-x: hidden;
    }

    .modal-dialog-slideout .modal-content {
        border: 0;
    }

    .modal-dialog-slideout .modal-header,
    .modal-dialog-slideout .modal-footer {
        height: 69px;
        display: block;
    }

    .modal-dialog-slideout .modal-header h5 {
        float: left;
    }


    .modal-body .row:hover {
    background-color: #f0f0f0; /* Change to the desired hover color */
    cursor: pointer; /* Optional: Change cursor to pointer on hover */
}

</style>

<div class="modal fade" id="notificationModal" tabindex="-1" role="dialog" aria-labelledby="notificationModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-slideout" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h3 class="modal-title" id="notificationModalLabel">Notifications</h3>
            </div>
            <div class="modal-body">


            @auth
            
              @foreach(auth()->user()->notifications as $notification)
              <a href="{{ route('admin.appointment.edit', ['appointment' => $notification->data['appointmentID']]) }}" style="text-decoration: none; color:black">
              <div class="row pt-3 pb-3">
                <div class="col-8">{{ $notification->data['clientName'] }} has requested an appointment for  

                @if (isset($notification->data['appointmentDateTime']))
                    {{ \Carbon\Carbon::parse($notification->data['appointmentDateTime'])->format('j M, H:i') }}
                @endif</div>
                
                <p class="col-4 text-muted text-right d-flex justify-content-end">{{ \Carbon\Carbon::parse($notification->created_at)->diffForHumans() }}</p>
                

              </div> 
            </a> 
          @endforeach
          @endauth




            </div>
            {{-- <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div> --}}
        </div>
    </div>
</div>
