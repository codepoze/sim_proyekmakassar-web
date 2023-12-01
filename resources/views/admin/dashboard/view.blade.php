<x-admin-layout title="{{ $title }}">
    <!-- begin:: css local -->
    @push('css')
    @endpush
    <!-- end:: css local -->

    <!-- begin:: content -->
    <section>
        <div class="row">
            <div class="col-6">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-10">
                                <h4 class="">0</h4>
                                <h6 class="text-muted m-b-0">Total SKPP Terbit</h6>
                            </div>
                            <div class="col-2 text-center">
                                <i data-feather="save"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-10">
                                <h4 class="">0</h4>
                                <h6 class="text-muted m-b-0">Total SKPP Terbit</h6>
                            </div>
                            <div class="col-2 text-center">
                                <i data-feather="save"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end:: content -->

    <!-- begin:: js local -->
    @push('js')
    @endpush
    <!-- end:: js local -->
</x-admin-layout>