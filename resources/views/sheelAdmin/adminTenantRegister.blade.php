<link rel="stylesheet" href="/css/tenantRegister.css">
@extends('layout')
@section('titel', '利用者新規登録画面')
@section('content')
    <div class=wrapper>
        <div class="content">
            <div class="registerBox">
                <h1>利用者新規登録</h1>

                <!-- Validation Errors -->
                <x-auth-validation-errors class="mb-4" :errors="$errors" />

                <form action="{{ route('adminTenantRegister') }}" method="POST">
                    @csrf
                    <div class="want">
                        <label for="name">
                            お名前:
                            <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')"
                                placeholder="山田太郎" />
                        </label>
                    </div>
                    <div class="want">
                        <label for="kana">
                            フリガナ:
                            <x-input id="kana" class="block mt-1 w-full" type="text" name="kana"
                                :value="old('kana')" placeholder="ヤマダタロウ" />
                        </label>
                    </div>
                    <div class="want">
                        <label for="age">
                            年齢:
                            <div class="pull">
                                <select name="age" id="age" class="age" :value="old('age')">
                                    <option value="">選択してください</option>
                                    <option value="0">0</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option>
                                    <option value="11">11</option>
                                    <option value="12">12</option>
                                    <option value="13">13</option>
                                    <option value="14">14</option>
                                    <option value="15">15</option>
                                    <option value="16">16</option>
                                    <option value="17">17</option>
                                    <option value="18">18</option>
                                    <option value="19">19</option>
                                    <option value="20">20</option>
                                    <option value="21">21</option>
                                    <option value="22">22</option>
                                    <option value="23">23</option>
                                    <option value="24">24</option>
                                    <option value="25">25</option>
                                    <option value="26">26</option>
                                    <option value="27">27</option>
                                    <option value="28">28</option>
                                    <option value="29">29</option>
                                    <option value="30">30</option>
                                    <option value="31">31</option>
                                    <option value="32">32</option>
                                    <option value="33">33</option>
                                    <option value="34">34</option>
                                    <option value="35">35</option>
                                    <option value="36">36</option>
                                    <option value="37">37</option>
                                    <option value="38">38</option>
                                    <option value="39">39</option>
                                    <option value="40">40</option>
                                    <option value="41">41</option>
                                    <option value="42">42</option>
                                    <option value="43">43</option>
                                    <option value="44">44</option>
                                    <option value="45">45</option>
                                    <option value="46">46</option>
                                    <option value="47">47</option>
                                    <option value="48">48</option>
                                    <option value="49">49</option>
                                    <option value="50">50</option>
                                    <option value="51">51</option>
                                    <option value="52">52</option>
                                    <option value="53">53</option>
                                    <option value="54">54</option>
                                    <option value="55">55</option>
                                    <option value="56">56</option>
                                    <option value="57">57</option>
                                    <option value="58">58</option>
                                    <option value="59">59</option>
                                    <option value="60">60</option>
                                    <option value="61">61</option>
                                    <option value="62">62</option>
                                    <option value="63">63</option>
                                    <option value="64">64</option>
                                    <option value="65">65</option>
                                    <option value="66">66</option>
                                    <option value="67">67</option>
                                    <option value="68">68</option>
                                    <option value="69">69</option>
                                    <option value="70">70</option>
                                    <option value="71">71</option>
                                    <option value="72">72</option>
                                    <option value="73">73</option>
                                    <option value="74">74</option>
                                    <option value="75">75</option>
                                    <option value="76">76</option>
                                    <option value="77">77</option>
                                    <option value="78">78</option>
                                    <option value="79">79</option>
                                    <option value="80">80</option>
                                    <option value="81">81</option>
                                    <option value="82">82</option>
                                    <option value="83">83</option>
                                    <option value="84">84</option>
                                    <option value="85">85</option>
                                    <option value="86">86</option>
                                    <option value="87">87</option>
                                    <option value="88">88</option>
                                    <option value="89">89</option>
                                    <option value="90">90</option>
                                    <option value="91">91</option>
                                    <option value="92">92</option>
                                    <option value="93">93</option>
                                    <option value="94">94</option>
                                    <option value="95">95</option>
                                    <option value="96">96</option>
                                    <option value="97">97</option>
                                    <option value="98">98</option>
                                    <option value="99">99</option>
                                    <option value="100">100</option>
                                    <option value="101">101</option>
                                    <option value="102">102</option>
                                    <option value="103">103</option>
                                    <option value="104">104</option>
                                    <option value="105">105</option>
                                    <option value="106">106</option>
                                    <option value="107">107</option>
                                    <option value="108">108</option>
                                    <option value="109">109</option>
                                    <option value="109">110</option>
                                </select> 歳
                            </div>
                        </label>
                    </div>
                    <div class="want">
                        <label for="sex">
                            性別:
                            <div class="radio">
                                <x-input id="sex" class="block mt-1 w-full" type="radio" name="sex"
                                    :value="'男性'" />男性
                                <x-input id="sex" class="block mt-1 w-full" type="radio" name="sex"
                                    :value="'女性'" />女性
                            </div>
                        </label>
                    </div>
                    <div class="want">
                        <label for="emergency_contact">
                            緊急連絡先:
                            <x-input id="emergency_contact" class="block mt-1 w-full" type="text"
                                name="emergency_contact" :value="old('emergency_contact')" placeholder="09012345678" />
                        </label>
                    </div>
                    <div class="want">
                        <label for="contact_name">
                            緊急連絡先名:
                            <x-input id="contact_name" class="block mt-1 w-full" type="text"
                                name="contact_name" :value="old('contact_name')" placeholder="山田花子（妻）" />
                        </label>
                    </div>
                    <div class="want">
                        <label for="institution_id">
                            入居施設:
                            <div class="pull">
                                <select name="institution_id" id="institution_id" class="block mt-1 w-full" :value="old('institution_id')">
                                    <option value="">選択してください</option>
                                    @foreach ($institutions as $institution)
                                        <option value="{{ $institution->id }}">{{ $institution->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </label>
                    </div>
                    <x-input class="send" type="submit" id="submit" value="登録" />
                </form>
            </div>
        </div>
        <div class="back">
            <button class="backButton" onClick="history.back();">戻る</button>
        </div>
    </div>
@endsection
