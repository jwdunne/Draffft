<?=$meta;?>
<div class="body-wrapper clr">
    <section class="grid-full">
        <form action="<?=Application::link('contact-us');?>" method="post" class="blocky-form" title="Press enter to send when finished!">
            <h1>Contact Us</h1>
            <input placeholder="Name" name="name">
            <input placeholder="Email" name="email">
            <textarea placeholder="Message" name="message"></textarea>
            <input type="submit" value="Send" />
        </form>
    </section>
</div>
<?=$footer;?>
