<div class="row">

    <div class="col-md-12">
        <div class="col-md-3">

            <div class="col-md-12">
                @if (empty($data['records_info'][0]->picture))
                    <img class="img-circle" src="{{ asset('img/record/user.png') }}" alt="User Avatar" style="max-height: 222px;">
                @else
                    <img class="img-circle" src="{{ asset($data['records_info'][0]->url_path) }}" alt="User Avatar" style="max-height: 222px;">
                @endif
            </div>

        </div>
        <div class="col-md-8">
            <div class="form-group col-xs-6 col-md-4">
                {{ trans('message.datatables_headers.name') }}<br />
                <label for="nombre" style="font-size: 17px"> {{ $data['employee_info'][0]->nombre }} </label>
            </div>

            <div class="form-group col-xs-6 col-md-4">
                {{ trans('message.datatables_headers.paterno') }}<br />
                <label for="nombre" style="font-size: 17px"> {{ $data['employee_info'][0]->paterno }} </label>
            </div>

            <div class="form-group col-xs-6 col-md-4">
                {{ trans('message.datatables_headers.materno') }}<br />
                <label for="nombre" style="font-size: 17px"> {{ $data['employee_info'][0]->materno }} </label>
            </div>

            <div class="form-group col-xs-6 col-md-4">
                {{ trans('message.ex.phone_number') }}<br />
                <label for="nombre" style="font-size: 17px"> {{ $data['employee_info'][0]->celular }} </label>
            </div>

            <div class="form-group col-xs-6 col-md-4">
                {{ trans('message.ex.home_number') }}<br />
                <label for="nombre" style="font-size: 17px"> {{ $data['employee_info'][0]->telefono }} </label>
            </div>

            <div class="form-group col-xs-6 col-md-4">
                {{ trans('message.ex.email') }}<br />
                <label for="nombre" style="font-size: 17px"> {{ $data['employee_info'][0]->correoempresa }} </label>
            </div>

            <div class="form-group col-xs-6 col-md-4">
                {{ trans('message.ex.gender') }}<br />
                <label for="nombre" style="font-size: 17px"> {{ $data['employee_info'][0]->sexo }} </label>
            </div>

            <div class="form-group col-xs-6 col-md-4">
                {{ trans('message.ex.birthday') }}<br />
                <label for="nombre" style="font-size: 17px"> {{ $data['employee_info'][0]->nacimiento }} </label>
            </div>

            <div class="form-group col-xs-6 col-md-4">
                {{ trans('message.ex.rfc') }}<br />
                <label for="nombre" style="font-size: 17px"> {{ $data['employee_info'][0]->rfc }} </label>
            </div>

        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">

            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-money"></i> {{ trans('message.ex.payroll_title') }}</h3>
            </div>

            <table class="table" id="tableNomina" style="width: 100%">
                <thead>
                    <tr>{{ trans('') }}
                        <td>{{ @Lang::get('message.ex.period') }}</td>
                        <td>{{ @Lang::get('message.ex.anio') }}</td>
                        <td>{{ @Lang::get('message.ex.period_type') }}</td>
                        <td>{{ @Lang::get('message.ex.payroll') }}</td>
                        <td>{{ @Lang::get('message.ex.payroll_file') }}</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data['nominas'] as $nomina)
                    <tr>
                        <td>{{ $nomina->period }}</td>
                        <td>{{ $nomina->year }}</td>
                        <td>{{ $nomina->type_period }}</td>
                        <td>{{ $nomina->file }}</td>
                        <td>
                            @if (!empty($nomina->file))
                                <form action="{{ url('nomina') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="idnomina" value="{{ $nomina->id }}">
                                    <button class="btn btn-primary" type="submit">Descargar</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
