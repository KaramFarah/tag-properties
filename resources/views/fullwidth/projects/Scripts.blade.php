@push('scripts')
    <script>
        $(document).ready(function() {
            $('.delete-range').on('click', function(event) {
                swal.fire({
                        title: "Are you sure?",
                        text: "You'r About To Delete This Record",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#d33",
                        cancelButtonColor: "#808080",
                        confirmButtonText: "Yes, delete it!"
                }).then((result) => {
                    if (result.isConfirmed) {
                            let delete_url = $(this).attr('data-value')
                            let liId = $(this).attr('parent-id')
                            $.ajax({
                                type: "DELETE",
                                url: delete_url,
                                success: function(response) {
                                    console.log(response.data)
                                    $('#' + liId).remove();
                                    console.log(delete_url)
                                    console.log(liId)
                                    //developer_name.val('')
                                },
                                error: function (request, status, error) {
                                    alert('Error!')
                                    console.log(delete_url)
                                    console.log(liId)
                                    console.log("request: "+request.toJSON())
                                    console.log("status: "+status)
                                    console.log("error: "+error)
                                }
                            });
                            event.preventDefault();
                            swal.fire({
                                title: "Deleted!",
                                text: "Your Record has been deleted.",
                                icon: "success"
                            });
                        }
                    });
                return false;
            });

            $('#addrange').click(function() {
                let myDiv = document.getElementById("formContainer")
                let loop_index = myDiv.childElementCount
                //let newRange = document.getElementById("newRangePlan").firstElementChild
                let apiRoute = "{{ route('dashboard.ranges.new-row') }}?loopIndex=" + loop_index
                $.ajax({
                    type: "GET",
                    url: apiRoute,
                    success: function(response) {
                        $('#formContainer').append(response);
                        console.log('1- loop: ' + loop_index)
                        loop_index++
                        let apiRoute = "{{ route('dashboard.ranges.new-row') }}?loopIndex=" + loop_index
                    },
                    error: function (response, request, status, error) {
                        console.log('2- loop: ' + loop_index)
                        console.log(response.responseText)
                        alert('Error!')
                        console.log("request: "+request.toJSON())
                        console.log("status: "+status)
                        console.log("error: "+error)
                    }
                })                       
            })

            $(document).on('click' , '.remove-range' , function(){
                console.log('we in remove range');
                // $(this).parent().remove();
                swal.fire({
                            title: "Are you sure?",
                            text: "You won't be able to revert this!",
                            icon: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#d33",
                            cancelButtonColor: "#808080",
                            confirmButtonText: "Yes, delete it!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        console.log(this);
                        $(this).closest('.Container').remove();
                        swal.fire({
                        title: "Deleted!",
                        text: "Your file has been deleted.",
                        icon: "success"
                                });
                            }
                        })
            })

            //places
            //************
            let myDiv = document.getElementById("placeContainer");
            let loop_index =  myDiv.childElementCount;
            let newPlace = document.getElementById("newNearbyPlace").firstElementChild;
            let apiRoute = "{{ route('api.nearby-places') }}" + "?loop_index=" + loop_index;

            $('#addNewPlace').click(function() {
                $.ajax({
                    type: "GET",
                    url: apiRoute,
                    success: function(response) {
                        $('#placeContainer').append(response);
                        loop_index++;
                        apiRoute = "{{ route('api.nearby-places') }}" + "?loop_index=" + loop_index;
                        // console.log(apiRoute)
                    },
                    error: function (response, request, status, error) {
                        console.log(response.responseText)
                        alert('Error!')
                        console.log("request: "+request.toJSON())
                        console.log("status: "+status)
                        console.log("error: "+error)
                    }
                });                            
            });

            $(document).on('click' , '.remove-place' , function(){
                // $(this).parent().remove();
                swal.fire({
                            title: "Are you sure?",
                            text: "You won't be able to revert this!",
                            icon: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#d33",
                            cancelButtonColor: "#d33",
                            confirmButtonText: "Yes, delete it!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $(this).closest('.Container').remove();
                        swal.fire({
                        title: "Deleted!",
                        text: "Your file has been deleted.",
                        icon: "success"
                                });
                            }
                        });
            });

            $('.delete-place').on('click', function(event) {
                swal.fire({
                        title: "Are you sure?",
                        text: "You'r About To Delete This Record",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#d33",
                        cancelButtonColor: "#808080",
                        confirmButtonText: "Yes, delete it!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        let delete_url = $(this).attr('data-value')
                        let liId = $(this).attr('parent-id')
                        $.ajax({
                            type: "DELETE",
                            url: delete_url,
                            success: function(response) {
                                console.log(response.data)
                                $('#' + liId).remove();
                                //developer_name.val('')
                            },
                            error: function (request, status, error) {
                                alert('Error!')
                                console.log("request: "+request.toJSON())
                                console.log("status: "+status)
                                console.log("error: "+error)
                            }
                        });
                        event.preventDefault();
                            swal.fire({
                                title: "Deleted!",
                                text: "Your Record has been deleted.",
                                icon: "success"
                            });
                        }
                    });
                return false;
            });
        });
    </script>
@endpush