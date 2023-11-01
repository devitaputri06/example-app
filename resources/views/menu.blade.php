<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Document</title>
</head>
<body>
    <div class="container-fluid border rounded-top" style="width: 187vh; margin-top: 25px; background-color: var(--bs-light);">
        <p class="fs-6 mt-3">Venturo - Laporan penjualan tahunan per menu</p>
    </div>
    <div>
    <div class="container-fluid border rounded-bottom border-top-0 pt-2 mb-4" style="width: 187vh; display: flex">
        <select class="form-select my-3 mx-2" id="select" style="width: 250px" aria-label="Default select example">
            <option>Pilih Tahun</option>
            @if ($tahun == 2021)
            <option value="2021" selected>2021</option>
            <option value="2022">2022</option>
            @elseif ($tahun == 2022)
            <option value="2021">2021</option>
            <option value="2022" selected>2022</option>
            @else
            <option value="2021">2021</option>
            <option value="2022">2022</option>
            @endif
        </select>

        
        <di2v style="margin: 20px">
                            <button type="submit" class="btn btn-primary">
                                Tampilkan
                            </button>
       
    <a href="http://tes-web.landa.id/intermediate/menu" target="_blank" rel="Array Menu" class="btn btn-secondary">
                                Json Menu
    </a>
    <a href="https://tes-web.landa.id/intermediate/transaksi?tahun=<?= $tahun ?>" target="_blank" rel="Array Transaksi" class="btn btn-secondary">
                                Json Transaksi
</a>
</div>

        @if ($tahun != null)<div class="container-fluid border-bottom" style="width: 181vh"></div>@endif
        @if ($transaction != null)
        <div class="mt-3 mx-2">
            <table class="table table-bordered table-hover" style="font-size: 11px;">
                <thead class="text-center">
                    <tr class="align-middle table-dark">
                        <th scope="col" rowspan="2">Menu</th>
                        <th scope="col" colspan="12">Periode Pada {{ $tahun }}</th>
                        <th scope="col" rowspan="2" style="width: 75px;">Total</th>
                    </tr>
                    <tr class="table-dark">
                        <th scope="col" style="width: 75px;">Jan</th>
                        <th scope="col" style="width: 75px;">Feb</th>
                        <th scope="col" style="width: 75px;">Mar</th>
                        <th scope="col" style="width: 75px;">Apr</th>
                        <th scope="col" style="width: 75px;">Mei</th>
                        <th scope="col" style="width: 75px;">Jun</th>
                        <th scope="col" style="width: 75px;">Jul</th>
                        <th scope="col" style="width: 75px;">Ags</th>
                        <th scope="col" style="width: 75px;">Sep</th>
                        <th scope="col" style="width: 75px;">Okt</th>
                        <th scope="col" style="width: 75px;">Nov</th>
                        <th scope="col" style="width: 75px;">Des</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="table-secondary">
                        <th scope="row" colspan="14">Makanan</th>
                    </tr> 
    
                    @foreach ($menu as $m)    
                        <tr>
                            <?php $total = 0; ?>
                            @if ($m['kategori'] == 'makanan')
                                <td scope="row">{{ $m['menu'] }}</td>
                                @for ($i = 1; $i <= 12; $i++)
                                    <?php $month = str_pad($i, 2, '0', STR_PAD_LEFT); ?>
                                    <td class="text-end">
                                        <?php $t = 0; ?>
                                        @foreach ($transaction as $item)
                                            @if ($item['menu'] == $m['menu'] && date('m', strtotime($item['tanggal'])) == $month)
                                                <?php
                                                $t += $item['total'];
                                                $total += $item['total'];
                                                ?>
                                            @endif
                                        @endforeach
                                        @if ($t > 0)    
                                        {{ number_format($t, 0, ',', ',') }}
                                        @endif
                                    </td>
                                @endfor
                                <td class="text-end fw-bold">{{ number_format($total, 0, ',', ',') }}</td>
                            @endif
                        </tr>
                    @endforeach
    
                    <tr class="table-secondary">
                        <th scope="row" colspan="14">Minuman</th>
                    </tr>
    
                    @foreach ($menu as $m)    
                        <tr>
                            <?php $total = 0; ?>
                            @if ($m['kategori'] == 'minuman')
                                <td scope="row">{{ $m['menu'] }}</td>
                                @for ($i = 1; $i <= 12; $i++)
                                    <?php $month = str_pad($i, 2, '0', STR_PAD_LEFT); ?>
                                    <td class="text-end">
                                        <?php $t = 0; ?>
                                        @foreach ($transaction as $item)
                                            @if ($item['menu'] == $m['menu'] && date('m', strtotime($item['tanggal'])) == $month)
                                                <?php
                                                $t += $item['total'];
                                                $total += $item['total'];
                                                ?>
                                            @endif
                                        @endforeach
                                        @if ($t > 0)    
                                        {{ number_format($t, 0, ',', ',') }}
                                        @endif
                                    </td>
                                @endfor
                                <td class="text-end fw-bold">{{ number_format($total, 0, ',', ',') }}</td>
                            @endif
                        </tr>
                    @endforeach
    
                    <tr class="table-dark">
                        <?php $total = 0; ?>
                        <th>Total</th>
                        @for ($i = 1; $i <= 12; $i++)
                            <?php $month = str_pad($i, 2, '0', STR_PAD_LEFT); ?>
                            <td class="text-end fw-bold">
                                <?php $t = 0; ?>
                                @foreach ($transaction as $item)
                                    @if (date('m', strtotime($item['tanggal'])) == $month)
                                        <?php
                                        $t += $item['total'];
                                        $total += $item['total'];
                                        ?>
                                    @endif
                                @endforeach
                                @if ($t > 0)    
                                {{ number_format($t, 0, ',', ',') }}
                                @endif
                            </td>
                        @endfor
                        <td class="text-end fw-bold">{{ number_format($total, 0, ',', ',') }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        @endif
    </div>
    <script>
        $(document).ready(function(){
            $('#select').change(function(){
                var selectedOption = $(this).val();

                if(selectedOption === '2021') {
                    window.location.href = '/2021';
                }else if(selectedOption === '2022') {
                    window.location.href = '/2022';
                }else {
                    window.location.href = '/';
                }
            });
        });
    </script>
</body>
</html>
