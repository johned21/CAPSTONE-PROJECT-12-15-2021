<table id="example" class="table table-striped table-hover table-bordered display nowrap" cellspacing="0" width="100%";>
    <thead>
        <tr>
            <th>Full Name</th>
            <th>Level</th>
            <th>Tracks</th>
            <th>Strand</th>
            <th>Date</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($enrolees as $enrolee)
        <tr class="data-row">
            <td>{{ $enrolee->student()->first()->lastName }}, {{ $enrolee->student()->first()->firstName }} {{substr($enrolee->student()->first()->middleName, 0, 1)}}.</td>
            <td>{{ $enrolee->level()->first()->level }}</td>
            <td>{{ $enrolee->track ?? 'N/A' }}</td>
            <td>{{ $enrolee->strand ?? 'N/A' }}</td>
            <td>{{ date_format($enrolee->created_at ,"Y/m/d H:i:s"); }}</td>
            <td class="text-center">
                <a class="btn btn-outline-primary tooltip-actbtn" href="{{route('admin.enrolees.view', ['enrolee' => "$enrolee->id"])}}"><i class="far fa-eye"></i>
                    <div class="top">
                        <p class="tooltiptxt">View</p>
                    </div>
                </a>
            </td>
        </tr>
        @endforeach
        
    </tbody>
    <tfoot>
        <tr>
            <th>Full Name</th>
            <th>Level</th>
            <th>Tracks</th>
            <th>Strand</th>
            <th>Date</th>
            <th>Action</th>
        </tr>
    </tfoot>
</table>