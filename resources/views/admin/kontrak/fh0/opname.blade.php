<x-admin-layout title="{{ $title }}">
    <!-- begin:: css local -->
    @push('css')
    @endpush
    <!-- end:: css local -->

    <!-- begin:: content -->
    <section>
        <div class="row">
            <div class="col-12">
                @if (count($opname) > 0)
                @foreach ($opname as $key => $value)
                <div class="card">
                    <div class="card-header border-bottom">
                        <div class="head-label">
                            <h4 class="card-title">Opname {{ $value->toKontrakRuasItem->nama }} Ke - {{ $key + 1 }} </h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <embed style="height: 100vh;" src="{{ asset_upload('pdf/'.$value->file) }}#toolbar=0" type="application/pdf" frameBorder="0" scrolling="auto" height="100%" width="100%"></embed>
                    </div>
                </div>
                @endforeach
                @else
                <div class="alert alert-primary" role="alert">
                    <div class="alert-body">Belum ada opname!</div>
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