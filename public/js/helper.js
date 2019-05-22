function invalid($input, is) {
    if (is)
        $input.addClass('is-invalid');
    else
        $input.removeClass('is-invalid');
}
