<x-admin-layout title="{{ $title }}">
    <!-- begin:: css local -->
    @push('css')
    @endpush
    <!-- end:: css local -->

    <!-- begin:: content -->
    <section>
        <div class="row">
            <div class="col-4">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-12">
                                <h4 class="">{{ $count_kegiatan }}</h4>
                                <h6 class="text-muted m-b-0">Total Kegiatan</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-12">
                                <h4 class="">{{ $count_paket }}</h4>
                                <h6 class="text-muted m-b-0">Total Paket</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-12">
                                <h4 class="">{{ $count_kontrak }}</h4>
                                <h6 class="text-muted m-b-0">Total Kontrak</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-12">
                                <h4 class="">{{ $count_pptk }}</h4>
                                <h6 class="text-muted m-b-0">Total PPTK</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-12">
                                <h4 class="">{{ $count_kord_teknis_lapangan }}</h4>
                                <h6 class="text-muted m-b-0">Total Kord Teknis Lapangan</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-12">
                                <h4 class="">{{ $count_angg_teknis_lapangan }}</h4>
                                <h6 class="text-muted m-b-0">Total Angg Teknis Lapangan</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                @foreach ($get_kontrak as $key => $val)
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Progress {{ $val['no_kontrak'] }}</h4>
                    </div>
                    <div class="card-body">
                        <div class="progress">
                            <div class="progress-bar bg-success" role="progressbar" style="width: {{ $val['total_progress'] }}%;" aria-valuenow="{{ $val['total_progress'] }}" aria-valuemin="0" aria-valuemax="100">{{ $val['total_progress'] }}%</div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- end:: content -->

    <!-- begin:: js local -->
    @push('js')
    @endpush
    <!-- end:: js local -->
</x-admin-layout>