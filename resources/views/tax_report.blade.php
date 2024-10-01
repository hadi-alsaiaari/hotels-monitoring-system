<!DOCTYPE html>
<html>
<body>
  <div style="flex-grow: 1;padding: 25px;margin-top: 60px;">
  <div style="display: flex;flex-wrap: wrap;margin-top: calc(-1 * var(--bs-gutter-y));margin-right: calc(-0.5 * var(--bs-gutter-x));margin-left: calc(-0.5 * var(--bs-gutter-x));">
    <div style="flex-shrink: 0;width: 100%;max-width: 100%;padding-right: calc(var(--bs-gutter-x) * 0.5);padding-left: calc(var(--bs-gutter-x) * 0.5);margin-top: var(--bs-gutter-y);">
    <div style="flex-direction: column;min-width: 0;height: var(--bs-card-height);word-wrap: break-word;background-color: var(--bs-card-bg);background-clip: border-box;border: var(--bs-card-border-width) solid var(--bs-card-border-color);border-radius: var(--bs-card-border-radius);">
    <div style="flex: 1 1 auto;padding: var(--bs-card-spacer-y) var(--bs-card-spacer-x);color: var(--bs-card-color);">
    <div style="justify-content: space-between !important;display: flex;width: 100%;padding-right: calc(var(--bs-gutter-x) * 0.5);padding-left: calc(var(--bs-gutter-x) * 0.5);">
      <div style="padding-left: 0 !important;">
        <p><b>REPUBLIC OF YEMEN</b></p>
        <p >Ministry of</p>
        <p>Tourism And Environment</p>
        <h5 ></h5>
      </div>
      <div style="margin-left:100px;">
        <h4 style="text-transform: uppercase !important;text-align: right !important;font-weight: 700 !important;margin-bottom: 0.5rem !important;">Republic of Yemen</h4>
        <h4 style="text-align: right !important;font-weight: 400 !important;margin-bottom: 0.5rem !important;">Ministry of Tourism</h4>
        <p>رقم( )<br> التاريخ:</p>
      </div>
    </div>
    <div style="margin-left:25%;">
      <div style="padding-right: 0 !important;">
    
      </div>
      <div style="padding-right: 150 !important">
        <p style="font-size: 15px;"><b>استمارة رسوم الإقامة للمنشآت الفندقية السياحية</b></p>
        <p style="font-size: 15px;">عن شهر: {{now()->month}}  لسنة: {{now()->year}}</p>
        <p style="font-size: 15px;">اسم الفندق: {{$hotel->trade_name}}  الدرجة: {{$hotel->class}}</p>
        <p style="font-size: 15px;">اسم مالك الفندق: {{$hotel->hotel_owner->identity->full_name}} العنوان: {{$hotel->location}}</p>
      </div>
    </div>
<table style="border: 1px solid black;margin-top:50px;caption-side: bottom;border-collapse: collapse;width: 100%;margin-bottom: 1rem;color: var(--bs-table-color);vertical-align: top;border-color: var(--bs-table-border-color);">
        <thead style="border: 1px solid black;">
          <tr style="border: 1px solid black;">

            <th colspan="2" rowspan="2" style="border: 1px solid black;"><center>الإجمالي</center></th>
            <th colspan="2" style="border: 1px solid black;"><center>شقق</center></th>
            <th colspan="2" style="border: 1px solid black;"><center>أجنحة</center></th>
            <th colspan="2" style="border: 1px solid black;"><center>3 أسرة</center></th>
            <th colspan="2" style="border: 1px solid black;"><center>مزدوجة</center></th>
            <th colspan="2" style="border: 1px solid black;">مفردة</th>
            <th rowspan="2" style="border: 1px solid black;"><center>مكونات الإيواء</center></th>
            <th style="border: 1px solid black;">#</th>
              </tr>
              <tr>
            
            <th style="border: 1px solid black;"><center>ب</center></th>
            <th style="border: 1px solid black;"><center>أ</center></th>
            <th style="border: 1px solid black;"><center>ب</center></th>
            <th style="border: 1px solid black;"><center>أ</center></th>

            <th style="border: 1px solid black;"><center>ب</center></th>
            <th style="border: 1px solid black;"><center>أ</center></th>
            <th style="border: 1px solid black;"><center>ب</center></th>
            <th style="border: 1px solid black;"><center>أ</center></th>
            <th style="border: 1px solid black;"><center>ب</center></th>
            <th style="border: 1px solid black;"><center>أ</center></th>
            
            
              </tr>
        </thead>
        <tbody style="border: 1px solid black;">
          <tr style="border: 1px solid black;">
            <td colspan="2" style="border: 1px solid black;"><center>{{$totel_taxes['total_components_accommodation'][10]}}</center></td>
            <td style="border: 1px solid black;">{{$totel_taxes['total_components_accommodation'][9]}}</td>
            <td style="border: 1px solid black;">{{$totel_taxes['total_components_accommodation'][8]}}</td>
            <td style="border: 1px solid black;">{{$totel_taxes['total_components_accommodation'][7]}}</td>
            <td style="border: 1px solid black;">{{$totel_taxes['total_components_accommodation'][6]}}</td>
            <td style="border: 1px solid black;">{{$totel_taxes['total_components_accommodation'][5]}}</td>
            <td style="border: 1px solid black;">{{$totel_taxes['total_components_accommodation'][4]}}</td>
            <td style="border: 1px solid black;">{{$totel_taxes['total_components_accommodation'][3]}}</td>
            <td style="border: 1px solid black;">{{$totel_taxes['total_components_accommodation'][2]}}</td>
            <td style="border: 1px solid black;">{{$totel_taxes['total_components_accommodation'][1]}}</td>
            <td style="border: 1px solid black;">{{$totel_taxes['total_components_accommodation'][0]}}</td>
            <td style="border: 1px solid black;"><center>إجمالي مكونات الإيواء</center></td>
            <td style="border: 1px solid black;">1</td>
            </tr>
            <tr >
              <td style="border: 1px solid black;" colspan="2"><center>{{$totel_taxes['monthli_occupancy_number'][10]}}</center></td>
              <td style="border: 1px solid black;">{{$totel_taxes['monthli_occupancy_number'][9]}}</td>
              <td style="border: 1px solid black;">{{$totel_taxes['monthli_occupancy_number'][8]}}</td>
              <td style="border: 1px solid black;">{{$totel_taxes['monthli_occupancy_number'][7]}}</td>
              <td style="border: 1px solid black;">{{$totel_taxes['monthli_occupancy_number'][6]}}</td>
              <td style="border: 1px solid black;">{{$totel_taxes['monthli_occupancy_number'][5]}}</td>
              <td style="border: 1px solid black;">{{$totel_taxes['monthli_occupancy_number'][4]}}</td>
              <td style="border: 1px solid black;">{{$totel_taxes['monthli_occupancy_number'][3]}}</td>
              <td style="border: 1px solid black;">{{$totel_taxes['monthli_occupancy_number'][2]}}</td>
              <td style="border: 1px solid black;">{{$totel_taxes['monthli_occupancy_number'][1]}}</td>
              <td style="border: 1px solid black;">{{$totel_taxes['monthli_occupancy_number'][0]}}</td>
              <td style="border: 1px solid black;"><center>عدد الإشغال الشهري</center></td>
              <td style="border: 1px solid black;">2</td>
              </tr>
              <tr style="border: 1px solid black;">
                <td style="border: 1px solid black;" colspan="2"><center>{{$totel_taxes['accommodation_unit_price'][10]}}</center></td>
                <td style="border: 1px solid black;">{{$totel_taxes['accommodation_unit_price'][9]}}</td>
                <td style="border: 1px solid black;">{{$totel_taxes['accommodation_unit_price'][8]}}</td>
                <td style="border: 1px solid black;">{{$totel_taxes['accommodation_unit_price'][7]}}</td>
                <td style="border: 1px solid black;">{{$totel_taxes['accommodation_unit_price'][6]}}</td>
                <td style="border: 1px solid black;">{{$totel_taxes['accommodation_unit_price'][5]}}</td>
                <td style="border: 1px solid black;">{{$totel_taxes['accommodation_unit_price'][4]}}</td>
                <td style="border: 1px solid black;">{{$totel_taxes['accommodation_unit_price'][3]}}</td>
                <td style="border: 1px solid black;">{{$totel_taxes['accommodation_unit_price'][2]}}</td>
                <td style="border: 1px solid black;">{{$totel_taxes['accommodation_unit_price'][1]}}</td>
                <td style="border: 1px solid black;">{{$totel_taxes['accommodation_unit_price'][0]}}</td>
                <td style="border: 1px solid black;"><center>سعر وحدة الإيواء</center></td>
                <td style="border: 1px solid black;">3</td>
                </tr>
                <tr style="border: 1px solid black;">
                  <td style="border: 1px solid black;" colspan="2"><center>{{$totel_taxes['total_monthly_income_occupancy'][10]}}</center></td>
                  <td style="border: 1px solid black;">{{$totel_taxes['total_monthly_income_occupancy'][9]}}</td>
                  <td style="border: 1px solid black;">{{$totel_taxes['total_monthly_income_occupancy'][8]}}</td>
                  <td style="border: 1px solid black;">{{$totel_taxes['total_monthly_income_occupancy'][7]}}</td>
                  <td style="border: 1px solid black;">{{$totel_taxes['total_monthly_income_occupancy'][6]}}</td>
                  <td style="border: 1px solid black;">{{$totel_taxes['total_monthly_income_occupancy'][5]}}</td>
                  <td style="border: 1px solid black;">{{$totel_taxes['total_monthly_income_occupancy'][4]}}</td>
                  <td style="border: 1px solid black;">{{$totel_taxes['total_monthly_income_occupancy'][3]}}</td>
                  <td style="border: 1px solid black;">{{$totel_taxes['total_monthly_income_occupancy'][2]}}</td>
                  <td style="border: 1px solid black;">{{$totel_taxes['total_monthly_income_occupancy'][1]}}</td>
                  <td style="border: 1px solid black;">{{$totel_taxes['total_monthly_income_occupancy'][0]}}</td>
                  <td style="border: 1px solid black;"><center>إجمالي الدخل الشهري للإشغال</center></td>
                  <td style="border: 1px solid black;">4</td>
                  </tr>
                  <tr style="border: 1px solid black;">
                    <td style="border: 1px solid black;" colspan="2"><center>{{$totel_taxes['taxes_owed'][10]}}</center></td>
                    <td style="border: 1px solid black;">{{$totel_taxes['taxes_owed'][9]}}</td>
                    <td style="border: 1px solid black;">{{$totel_taxes['taxes_owed'][8]}}</td>
                    <td style="border: 1px solid black;">{{$totel_taxes['taxes_owed'][7]}}</td>
                    <td style="border: 1px solid black;">{{$totel_taxes['taxes_owed'][6]}}</td>
                    <td style="border: 1px solid black;">{{$totel_taxes['taxes_owed'][5]}}</td>
                    <td style="border: 1px solid black;">{{$totel_taxes['taxes_owed'][4]}}</td>
                    <td style="border: 1px solid black;">{{$totel_taxes['taxes_owed'][3]}}</td>
                    <td style="border: 1px solid black;">{{$totel_taxes['taxes_owed'][2]}}</td>
                    <td style="border: 1px solid black;">{{$totel_taxes['taxes_owed'][1]}}</td>
                    <td style="border: 1px solid black;">{{$totel_taxes['taxes_owed'][0]}}</td>
                    <td style="border: 1px solid black;"><center> ({{$percentage}}) الرسوم المستحقة قانونا بواقع</center></td>
                    <td style="border: 1px solid black;">5</td>
                    </tr>
        </tbody>
      </table>

    </div>
  </div>
      </div>
  </div>
</div>
</body>

</html>
