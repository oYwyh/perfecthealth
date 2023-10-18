<x-splade-modal>
    <div class="patient-info">
        <div class="info">Fullname: <span>{{$patient->first_name}} {{$patient->last_name}}</span></div>
        <div class="info">Age: <span>{{$patient->date_of_brith ? $carbon->now()->diff($patient->date_of_brith)->y : 'Unkown'}}</span></div>
        <div class="info">Gender: <span>{{$patient->gender ? $patient->gender : 'Unkown'}}</span></div>
        <div class="info">Blood Type: <span>{{$patient->blood ? $patient->blood : 'Unkown'}}</span></div>
        <div class="info">Disease: <span>{{$patient->disease ? $patient->disease : 'Unkown'}}</span></div>
        <div class="info">Weight: <span>{{$patient->weight ? $patient->weight : 'Unkown'}}</span></div>
        <div class="info">Height: <span>{{$patient->height ? $patient->height : 'Unkown'}}</span></div>
        <div class="info">Phone Number: <span>{{$patient->phone ? $patient->phone : 'Unkown'}}</span></div>
        <div class="info">National id: <span>{{$patient->national_id ? $patient->national_id : 'Unkown'}}</span></div>
        <div class="title">
            Investigations
        </div>
        <div class="box">
            @if ($patient->investigations)
                @foreach (explode(',', $patient->investigations) as $inv)
                    <div class="img-box">
                        <img src="{{asset($inv)}}" alt="">
                    </div>
                @endforeach
                @else
                <p class="note text-red-500">No Investigations</p>
            @endif
        </div>
        <div class="info">Insurance: <span>{{$patient->insurance  ? $patient->insurance : 'Unkown'}}</span></div>
        <div class="title">
            Insurance Card
        </div>
        <div class="box">
            @if ($patient->insurance_card)
                @foreach (explode(',', $patient->insurance_card) as $card)
                    <div class="img-box">
                        <img src="{{asset($card)}}" alt="">
                    </div>
                @endforeach
                @else
                <p class="note text-red-500">No Insurance Card</p>
            @endif

        </div>
        <div class="title">
            Insurance Id
        </div>
        <div class="box">
            @if ($patient->insurance_id)
                @foreach (explode(',', $patient->insurance_id) as $id)
                    <div class="img-box">
                        <img src="{{asset($id)}}" alt="">
                    </div>
                @endforeach
                @else
                <p class="note text-red-500">No Insurance id</p>
            @endif

        </div>

    </div>
</x-splade-modal>
