var Waterfall = function(opts) {
	var defaults = {
		Hbottom: 30,
		parent: '#list',
		child: 'dl',
		paddingLR: '20px'
	};
	this.opts = $.extend(defaults, opts);
	return this._init();
};
Waterfall.prototype = {
	_init: function() {
		this.opts.Hbottom = parseInt(this.opts.Hbottom);
		var t;
		this.OList = $(this.opts.parent);
		Odl = this.OList.find(this.opts.child);
		Odl.css({
			'opacity': '1',
			'display': 'inline-block'
		});
		Odl.eq(0).css({
			'top': 0,
			'left': this.opts.paddingLR,
		});
		Odl.eq(1).css({
			'top': 0,
			'right': this.opts.paddingLR
		});
		this.odd = Odl.eq(0).height() + this.opts.Hbottom;
		this.even = Odl.eq(1).height() + this.opts.Hbottom;
		return this._resolve();
	},
	_resolve: function() {
		for (var i = 2; i < Odl.length; i++) {
			if (this.odd > this.even) this.Mheight = this.odd;
			else this.Mheight = this.even;
			this.OList.css("height", this.Mheight + 'px');
			/*console.log(this.odd,this.even,this.Mheight,Odl.eq(i).height());*/
			if (this.odd < this.even) {
				Odl.eq(i).css({
					'top': this.odd + 'px',
					'left': this.opts.paddingLR
				});
				this.odd = parseInt(this.odd) + Odl.eq(i).height() + this.opts.Hbottom; //奇数
			} else {
				Odl.eq(i).css({
					'top': this.even + 'px',
					'right': this.opts.paddingLR
				});
				this.even += (Odl.eq(i).height() + this.opts.Hbottom); //偶数
			}

		};
		if (this.odd > this.even) this.Mheight = this.odd;
		else this.Mheight = this.even;
		this.OList.css("height", this.Mheight + 'px');
	}
};
