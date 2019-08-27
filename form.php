<div class="hcf_box">
    <style scoped>
        .hcf_field{
            display: flex;
            flex-direction: column;
        }
        .meta-options label {
            font-weight: bold;
            font-size: 21px;
        }
    </style>
    <p class="meta-options hcf_field">
        <label for="show_date">Show Date</label>
        <input id="show_date" type="date" name="show_date">
    </p>
    <p class="meta-options hcf_field">
        <label for="show_link">Show Link</label>
        <input id="show_link"
            type="text"
            name="show_link"
            value="<?php echo esc_attr( get_post_meta( get_the_ID(), 'hcf_author', true ) ); ?>">
    </p>
</div>