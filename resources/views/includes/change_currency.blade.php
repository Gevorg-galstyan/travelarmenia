<select name="change_currency">
    <option data-name="amd" value="amd" {{session('valuta_marka') == 'amd' ? 'selected' : ''}}>
        AMD ֏
    </option>
    <option data-name="usd" value="usd" {{session('valuta_marka') == 'usd' ? 'selected' : ''}}>
        USD $
    </option>
    <option data-name="eur" value="eur" {{session('valuta_marka') == 'eur' ? 'selected' : ''}}>
        EUR &#8364
    </option>
    <option data-name="rub" value="rub" {{session('valuta_marka') == 'rub' ? 'selected' : ''}}>
        RUB &#8381
    </option>
</select>