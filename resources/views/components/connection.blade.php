<div class="my-2 shadow text-white bg-dark p-1" id="">
    <div class="d-flex justify-content-between">
        <table class="ms-1">

            <td class="align-middle">{{ $name }}</td>
            <td class="align-middle"> - </td>
            <td class="align-middle">{{ $email }}</td>
            <td class="align-middle">
        </table>
        <div>
            <button style="width: 220px" id="get_connections_in_common_" class="btn btn-primary" type="button"
                data-bs-toggle="collapse" data-bs-target="#collapse_{{ $id }}" aria-expanded="false"
                aria-controls="collapseExample">
                Connections in common ({{ count($commonfriends) }})
            </button>

            <form action="{{ url('user/request') }}" method="POST">
                @csrf
                <input type="hidden" value="{{ $id }}" name="id">
                <button id="cancel_request_btn_" class="btn btn-danger me-1">Remove Connection</button>
            </form>
        </div>

    </div>
    <div class="collapse" id="collapse_{{ $id }}">

        <div id="content_" class="p-2">
            {{-- Display data here --}}
            @foreach ($commonfriends as $friend)
                <x-connection_in_common :name="$friend['name'] ?? ''" :email="$friend['email'] ?? ''" />
            @endforeach
        </div>
        <div id="connections_in_common_skeletons_">
            {{-- Paste the loading skeletons here via Jquery before the ajax to get the connections in common --}}
        </div>
        <div class="d-flex justify-content-center w-100 py-2">
            <button class="btn btn-sm btn-primary" id="load_more_connections_in_common_">Load
                more</button>
        </div>
    </div>
</div>
