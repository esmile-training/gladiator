$(function(){
    // �w�b�_�[�ƃt�b�^�[�̍����̕����擾
    var headerHeight = $('.headerPosition > img').height();
    var footerHeight = $('.footerPosition > img').height();
    
    var main = document.getElementById( "main" );
    
    // �w�b�_�[�̉摜�̉e�̕������l�߂�
    headerHeight = headerHeight-(headerHeight/8);
    
    // main�̏㉺�̕����󂯂�
	main.style.marginBottom = footerHeight+'px';
    
	var body =  $('body').height();
	body = body - (headerHeight + footerHeight);
	main.style.height = body+'px';
	

});
