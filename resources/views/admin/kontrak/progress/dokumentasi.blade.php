<x-admin-layout title="{{ $title }}">
    <!-- begin:: css local -->
    @push('css')
    @endpush
    <!-- end:: css local -->

    <!-- begin:: content -->
    <section>
        <div class="row">
            <div class="col-12">
                @if (count($dokumentasi) > 0)
                @foreach ($dokumentasi as $key => $value)
                <div class="card">
                    <div class="card-header border-bottom">
                        <div class="head-label">
                            <h4 class="card-title">{{ $value->keterangan }}</h4>
                        </div>
                    </div>
                    <div class="card-body p-2">
                        <div class="row">
                            @foreach ($value->toDokumentasiFoto as $k => $v)
                            <div class="col-3">
                                <img src="{{ asset_upload('picture/'.$v->foto)  }}" class="img-fluid mx-auto d-block" />
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endforeach
                @else
                <div class="alert alert-primary" role="alert">
                    <div class="alert-body">Belum ada dokumentasi!</div>
                </div>
                @endif
            </div>
        </div>
    </section>
    <!-- end:: content -->

    <!-- begin:: js local -->
    @push('js')
    @endpush
    <!-- end:: js local -->
</x-admin-layout>