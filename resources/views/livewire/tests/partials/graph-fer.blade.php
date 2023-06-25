@if ($test->efficacite >= 95)
    <div class=" text-green-900 px-2 py-5 rounded-r-full border-l-8 border-green-600 ">{{ $intervalle }} jours plus tard: {{ $test->opg1 }} opg</div>
@elseif($test->efficacite >= 90)
    <div class="bg-orange-400 px-2 py-5 rounded-r-full w-1/12 overflow-x-visible whitespace-nowrap">{{ $intervalle }} jours plus tard: {{ $test->opg1 }} opg</div>
@elseif ($test->efficacite >= 80)
    <div class="bg-orange-400 px-2 py-5 rounded-r-full w-2/12 overflow-x-visible whitespace-nowrap">{{ $intervalle }} jours plus tard: {{ $test->opg1 }} opg</div>
@elseif ($test->efficacite >= 70)
    <div class="bg-red-400  px-2 py-5 rounded-r-full w-3/12 ">{{ $intervalle }} jours plus tard: {{ $test->opg1 }} opg</div>
@elseif ($test->efficacite >= 60)
    <div class="bg-red-500 px-2 py-5 rounded-r-full w-4/12 ">{{ $intervalle }} jours plus tard: {{ $test->opg1 }} opg</div>
@elseif ($test->efficacite >= 50)
    <div class="bg-red-600 text-white px-2 py-5 rounded-r-full w-5/12 ">{{ $intervalle }} jours plus tard: {{ $test->opg1 }} opg</div>
@elseif ($test->efficacite >= 40)
    <div class="bg-red-700 text-white px-2 py-5 rounded-r-full w-6/12 ">{{ $intervalle }} jours plus tard: {{ $test->opg1 }} opg</div>
@elseif ($test->efficacite >= 30)
    <div class="bg-red-700 text-white px-2 py-5 rounded-r-full w-7/12 ">{{ $intervalle }} jours plus tard: {{ $test->opg1 }} opg</div>
@elseif ($test->efficacite >= 20)
    <div class="bg-red-700 text-white px-2 py-5 rounded-r-full w-8/12 ">{{ $intervalle }} jours plus tard: {{ $test->opg1 }} opg</div>
@elseif ($test->efficacite >= 10)
    <div class="bg-red-800 text-white px-2 py-5 rounded-r-full w-10/12 ">{{ $intervalle }} jours plus tard: {{ $test->opg1 }} opg</div>
@elseif ($test->efficacite == 0)
    <div class="bg-red-900 text-white px-2 py-5 rounded-r-full w-12/12 ">{{ $intervalle }} jours plus tard: {{ $test->opg1 }} opg</div>
@endif
