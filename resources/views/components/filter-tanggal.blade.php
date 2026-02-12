<div class="ft">
    <button type="button" class="ft__btn" id="ftBtn">
        Filter
    </button>

    <form method="GET"
          action="{{ $action }}"
          class="ft__card"
          id="ftCard">

        @foreach($preserve as $key => $val)
            <input type="hidden" name="{{ $key }}" value="{{ $val }}">
        @endforeach

        <h4>Filter</h4>
        <p class="ft__sub">Tanggal Pembuatan</p>

        <div class="ft__field">
            <label>Dari</label>
            <input type="date" name="from" value="{{ request('from') }}">
        </div>

        <div class="ft__field">
            <label>Ke</label>
            <input type="date" name="to" value="{{ request('to') }}">
        </div>

        <div class="ft__actions">
            <button type="button" class="ft__reset" id="ftReset">
                Reset
            </button>
            <button type="submit" class="ft__apply">
                Terapkan
            </button>
        </div>
    </form>
</div>
