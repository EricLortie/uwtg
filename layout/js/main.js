jQuery(document).on('ready', function(){

  jQuery('.skill_expander').on('click', function(){
    var desc = jQuery(this).closest('.skill_row').find('.skill_desc');
    desc.slideToggle();
  });

  jQuery('.skill_closer').on('click', function(e){
    e.preventDefault();
    var desc = jQuery(this).closest('.skill_desc');
    desc.slideToggle();
  });

  jQuery('.skill_add').on('click', function(){
    if(jQuery(this).hasClass('spell_sphere_add')) {
      update_spell_spheres();
    }
    var skill_row = jQuery(this).closest('.skill_row');

    add_skill_to_character(skill_row);

    if(jQuery(this).data('name') == 'Favoured'){
      jQuery('#details_section').hide();
      jQuery('#occupation_selector').show();
    }
    if(skill_row.data('name') == 'Vocation'){
      jQuery('#details_section').hide();
      jQuery('#vocation_selector').show();
    }
  });

  jQuery('#btn_reset').on('click', function(){
    jQuery('.mandatory_section').hide();
    jQuery('#character_section').hide();
    jQuery('#data_fields').hide();
    jQuery('.non_data_fields:not(#character_section)').show();
    jQuery('#btn_generate').show();
    jQuery('#btn_generate').addClass('locked');
    jQuery('#cb_selectors').show();
    jQuery('#cb_race_show').html('');
    jQuery('#cb_class_show').html('');
    jQuery('#menu_launcher').show();
    reset_character();
    reset_skills();
  });

  function set_race(race, frag_cost){
    builder_data.character.frags_spent = 0;
    builder_data.character.race = race;
    jQuery('#cb_race_show').html(race);;
    if(typeof frag_cost != 'undefined' && frag_cost != ''){
      builder_data.character.frags_spent = parseInt(frag_cost);
    }

    jQuery('.skill_row').each(function(){
      skill_ele = jQuery(this);
      set_skill_cost_and_visibility(skill_ele);
    });
    if (builder_data.character.race != '' && builder_data.character.class != '') {
      jQuery('#btn_generate').removeClass('locked');
    } else {
      jQuery('#btn_generate').addClass('locked');
    }

  }

    function set_occupation(pc_class, cost_ele){
      var old_cp_count = (builder_data.character.cp_spent + builder_data.character.cp_avail);
      var old_frag_count = builder_data.character.frags_spent;
      var old_blankets_spent = builder_data.character.blankets_spent;
      var old_level = builder_data.character.level;
      var old_class = builder_data.character.class;
      if(cost_ele == "dra_cost" || cost_ele == "lig_cost" || cost_ele == "dar_cost"){
        cost_ele = "dem_cost";
      } else {
        cost_ele = "cha_cost";
      }
      reset_character();
      set_class(pc_class, 50, cost_ele)
      builder_data.character.old_class = old_class;
      builder_data.character.class = pc_class;
      builder_data.character.cp_avail = old_cp_count;
      builder_data.character.frags_spent = old_frag_count;
      builder_data.character.blankets_spent = old_blankets_spent;
      builder_data.character.level = old_level;
      update_character();

      jQuery('.skill_row.'+pc_class.replace(' ','')).each(function(){
        jQuery(this).data('class_restricted', false);
      });

      add_automatic_skills();
      update_skills();

      jQuery('#occupation_selector').hide();
      jQuery('#details_section').show();
    }
    function set_vocation(pc_class){

      builder_data.character.vocation = pc_class;

      jQuery('#char_vocation').show();
      jQuery('#cb_vocation_show').html(pc_class);

      jQuery('.skill_row').each(function(){
        if(jQuery(this).data('class_skill')){
          if(jQuery(this).hasClass(pc_class.replace(' ',''))){
            jQuery(this).data('class_restricted', false);
            jQuery(this).removeClass('restricted');
            jQuery(this).show();
          } else {
            jQuery(this).data('class_restricted', true);
            jQuery(this).addClass('restricted');
            jQuery(this).hide();
          }
        }
      });


      jQuery('#vocation_selector').hide();
      jQuery('#details_section').show();
    }

  function set_class(pc_class, frag_cost, cost_ele){
    builder_data.character.class = pc_class;
    builder_data.character.cost_element = cost_ele;

    if(pc_class == "Mercenary" || pc_class == "Ranger" || pc_class == "Templar"){
      builder_data.type = "w";
      builder_data.type_string = "Warrior";
    } else if (pc_class == "Assassin" || pc_class == "Nightblade" || pc_class == "Witch Hunter") {
      builder_data.type = "r";
      builder_data.type_string = "Rogue";
    } else {
      builder_data.type = "s";
      builder_data.type_string = "Scholar";
    }

    jQuery('#cb_class_show').html(pc_class);
    jQuery('.skill_cost').hide();

    jQuery('.skill_row').each(function(){
      skill_ele = jQuery(this);
      set_skill_cost_and_visibility(skill_ele);
    });


    if (builder_data.character.race != '' && builder_data.character.class != '') {
      jQuery('#btn_generate').removeClass('locked');
    } else {
      jQuery('#btn_generate').addClass('locked');
    }

  }

  function set_skill_cost_and_visibility(skill_ele) {
    if(skill_ele.data('class_skill') == true){

      skill_ele.find('.level_cost').show();
      if(skill_ele.data('class') != builder_data.character.class ){
        skill_ele.data('class_restricted', true);
      } else {
        skill_ele.data('class_restricted', false);
      }
      if(skill_ele.data('race') != builder_data.character.race ){
        skill_ele.data('race_restricted', true);
      } else {
        skill_ele.data('race_restricted', false);
      }
      skill_ele.data('cost', parseInt(skill_ele.find('.level_cost').html()));

    } else if (skill_ele.data('spell_sphere')) {
      skill_ele.data('cost', builder_data.character.sphere_cost);
    } else if(skill_ele.data('racial_skill') == true){
      skill_ele.find('.racial_cost').show();

      if(skill_ele.data('race') != builder_data.character.race){
        skill_ele.data('race_restricted', true);
      } else {
        skill_ele.data('race_restricted', false);
      }
      skill_ele.data('cost', parseInt(skill_ele.find('.cost').html()));

    } else {
      if (skill_ele.data('frag_cost') > 0) {
        if (skill_ele.data('class') != "All" && skill_ele.data('cat_string') != builder_data.type_string){
          //skill_ele.data('class_restricted', true);
          skill_ele.addClass('cat_restricted');
        } else {
          //skill_ele.data('class_restricted', false);
          skill_ele.removeClass('cat_restricted');
        }
      }

      skill_ele.find('.' + builder_data.character.cost_element).show();
      skill_ele.data('cost', parseInt(skill_ele.find('.' + builder_data.character.cost_element).html()));
    }
    skill_ele.find('span.cost').html(skill_ele.data('cost'));
  }

  jQuery('#btn_generate').on('click', function(e){
    e.preventDefault();
    if (builder_data.character.class != '' && builder_data.character.race != '') {
      reset_character();
      jQuery('.mandatory_section').show();
      jQuery(this).hide();
      jQuery('#cb_selectors').hide();
      jQuery('#menu_launcher').hide();
      add_automatic_skills();
    }
  });

  jQuery('.state_saver').on('click', function(e){
    e.preventDefault();
    set_state();
  });

  jQuery('#btn_add_blanket').on('click', function(e){
    e.preventDefault();
    builder_data.character.blankets_spent += 1;
    builder_data.character.cp_avail += builder_data.character.blanket_value;
    builder_data.character.cp_total = (builder_data.character.cp_avail + builder_data.character.cp_spent);
    if(builder_data.character.cp_total >= (builder_data.character.level_data['cp']+100)){
      builder_data.character.level += 1;
      builder_data.character.level_data = builder_data.level_chart[builder_data.character.level-1];
      builder_data.character.blanket_value = builder_data.character.level_data.cppb;
      builder_data.character.body_points = builder_data.character.level_data['bp_' + builder_data.type];
    }
    update_character();
  });

  jQuery('#btn_sort_cost').on('click', function(){
    toggleSort('cost');
  });

  jQuery('#btn_sort_name').on('click', function(){
    toggleSort('name');
  });

  function toggleSort(type) {
    jQuery('.btn-sort').toggleClass('active');
    if(type == "name"){
      jQuery('#sort_string').html('NAME');
      tinysort('.skill_row', 'span.name');
    } else {
      jQuery('#sort_string').html('COST');
      tinysort('.skill_row', 'span.cost');
    }
  }

  jQuery('#btn_toggle_skills').on('click', function(){
    if(jQuery('#skill_list').hasClass('avail_only')){
      jQuery('#filter_string').html("AVAILABLE");
    } else {
        jQuery('#filter_string').html("ALL");
    }
    jQuery(this).toggleClass('active');
    jQuery('#skill_list').toggleClass('avail_only');
  });

  jQuery('.btn-cat').on('click', function(){
    var cat = jQuery(this).data('cat');
    var cat_string = jQuery(this).data('catString');
    builder_data.toggle = cat_string;
    jQuery('.skill_row').css('display', '');
    jQuery('#skill_list').removeClass('S');
    jQuery('#skill_list').removeClass('W');
    jQuery('#skill_list').removeClass('R');
    jQuery('#skill_list').removeClass('P');
    jQuery('#skill_list').removeClass('A');
    jQuery('#skill_list').removeClass('C');
    jQuery('.btn-cat').removeClass('active');
    jQuery(this).addClass('active');
    jQuery('#skill_list').addClass(cat);
    jQuery('#cat_string').html(cat_string);

  });

  jQuery('#btn_frag').on('click', function(){
    jQuery('.skill_row').hide();
    jQuery('.frag_row').show();
  });

  jQuery('#opt-clear').on('click', function(){
    builder_data.toggle = "";
    jQuery('#filter_string').html("ALL");
    jQuery('#skill_list').removeClass('avail_only');
    jQuery('#skill_list').removeClass('S');
    jQuery('#skill_list').removeClass('W');
    jQuery('#skill_list').removeClass('R');
    jQuery('#skill_list').removeClass('P');
    jQuery('#skill_list').removeClass('A');
    jQuery('#skill_list').removeClass('C');
    jQuery('.btn-cat').removeClass('active');
    jQuery('#cat_string').html("");
    jQuery('#sort_string').html('NAME');
    tinysort('.skill_row', 'span.name');
  });


  function add_skill_to_character(skill_ele){
    if(skill_ele.data('multiple') == false || skill_ele.data('multiple') == "" || skill_ele.data('multiple') == 0){
      skill_ele.find('.skill_add').hide();
      skill_ele.find('.skill_purchased').slideToggle();
      skill_ele.addClass('purchased');
    }
    if(skill_ele.data('sphere')){
      builder_data.character.spell_spheres += 1;
    }
    if(builder_data.character.skills.hasOwnProperty(skill_ele.data('name'))) {
      builder_data.character.skills[skill_ele.data('name')] += 1;
    } else {
      builder_data.character.skills[skill_ele.data('name')] = 1;
    }

    builder_data.character.cp_avail -= skill_ele.data('cost');
    builder_data.character.cp_spent += skill_ele.data('cost');
    if(typeof skill_ele.data('frag_cost') != 'undefined'){
      builder_data.character.frags_spent += parseInt(skill_ele.data('frag_cost'));
    }
    builder_data.character.skill_count += 1
    if(builder_data.character.last_class_skill_level < skill_ele.data('class_level')){
      builder_data.character.last_class_skill_level = skill_ele.data('class_level');
    }
    jQuery('#cb_skill_count').html(builder_data.character.skill_count);
    update_character();
    update_skills();
  }

  function reset_character() {

    builder_data.character.vocation = "";
    builder_data.character.occupation = "";
    jQuery('#char_occupation').hide();
    jQuery('#cb_occupation_show').html("");
    jQuery('#char_vocation').hide();
    jQuery('#cb_vocation_show').html("");

    builder_data.character.level = 1;
    builder_data.character.blankets_spent = 0;
    builder_data.character.cp_avail = 150;
    if(builder_data.character.race == "Human"){
      builder_data.character.cp_avail = 200;
      builder_data.character.level_data = builder_data.human_level_chart[0];
    } else {
      builder_data.character.level_data = builder_data.level_chart[0];
    }
    builder_data.character.last_class_skill_level = 0;
    builder_data.character.spell_spheres = 0;
    builder_data.character.cp_spent = 0;
    builder_data.character.cp_total = 0;
    builder_data.character.blanket_value = builder_data.character.level_data.cppb;
    builder_data.character.body_points = builder_data.character.level_data['bp_' + builder_data.type];
    builder_data.character.skills = {};
    builder_data.character.skill_count = 0;


    update_character();

    tinysort('.skill_row', 'span.name');

  }

  function add_automatic_skills(){

    jQuery('span:contains("Weapon Group Proficiency: Simple")').closest('.skill_row').find('.skill_add').trigger('click');

    jQuery('.automatic_skill').each(function(){
      var $btn_add = jQuery(this);
      if(jQuery(this).closest('.skill_row').data('race') == builder_data.character.race){
        $btn_add.trigger('click');
      }
    });
  }

  function update_character(){
    jQuery('#cb_race_show').html(builder_data.character.race);
    jQuery('#cb_class_show').html(builder_data.character.class);
    jQuery('#cb_blankets_spent').html(builder_data.character.blankets_spent);
    jQuery('#cb_blanket_next').html(builder_data.character.blanket_value);
    jQuery('#cb_cp_avail').html(builder_data.character.cp_avail);
    jQuery('#cb_level').html(builder_data.character.level);
    jQuery('#cb_cp_spent').html(builder_data.character.cp_spent);
    jQuery('#cb_frags_spent').html(builder_data.character.frags_spent);
    jQuery('#cb_bp').html(builder_data.character.body_points);
    jQuery('#cb_skills').html(output_skills(builder_data.character.skills));
    jQuery('#cb_skill_count').html(builder_data.character.skill_count);

    builder_data.character.sphere_cost = builder_data.sphere_chart[builder_data.character.spell_spheres][builder_data.character.cost_element];
    jQuery('.sphere_cost').show();
    jQuery('.sphere_cost').closest('.skill_row').data('cost', builder_data.character.sphere_cost);
    jQuery('.sphere_cost').closest('.skill_row').find('span.cost').html(builder_data.character.sphere_cost);
    jQuery('.sphere_cost').html(builder_data.character.sphere_cost);

    update_skills();

  }

  function set_state(){
    state_counter += 1;
    jQuery('#btn_undo').removeClass('locked');
    builder_data.character_states.unshift({'count': state_counter, 'character': jQuery.extend(true, {}, builder_data.character)});
    if(builder_data.character_states.length > 5){
      builder_data.character_states.splice(4, 1);
    }
  }

  jQuery('#btn_undo').on('click', function(e){
    e.preventDefault();
    if(!jQuery(this).hasClass('locked')){
      undo();
    }
  });

  function undo() {
    builder_data.character = jQuery.extend(true, {}, builder_data.character_states[0]['character']);
    builder_data.character_states.splice(0, 1);
    if(builder_data.character_states.length == 0){
      jQuery('#btn_undo').addClass('locked');
    }
    update_character();
    update_skills();
  }

  function output_skills(skills) {
    html = "<ul>";
    for (skill in skills) {
      if (skills.hasOwnProperty(skill)) {
        var skill_string = skill;
        if(skills[skill] > 1) {
          skill_string = skill_string + " X" + skills[skill];
        }
        html += "<li>"+skill_string + "</li>";
      }
    }
    html += "</ul>";
    return html;
  }

  function update_skills() {
    jQuery('.skill_row').each(function(){
      var name = jQuery(this).data('name');
      var cost = parseInt(jQuery(this).data('cost'));
      if (isNaN(cost)){
        cost = 0;
      }
      var has_req = (jQuery(this).data('requirements') != "");
      var spell_circle = is_spell_circle(name);

      if(jQuery(this).data('class_skill')){
        if(jQuery(this).data('class_restricted')){
          jQuery(this).addClass('restricted');
          jQuery(this).hide();
        } else if(builder_data.toggle == "Class" || builder_data.toggle == "") {
          jQuery(this).show();
        } else {
          jQuery(this).removeClass('restricted');
          jQuery(this).show();
        }
      }

      if(jQuery(this).data('racial_skill')){
        if(jQuery(this).data('race_restricted')){
          jQuery(this).addClass('restricted');
          jQuery(this).hide();
        } else if(builder_data.toggle == "Race" || builder_data.toggle == "") {
          jQuery(this).show();
        }
      }
      if (cost > builder_data.character.cp_avail
          || ((jQuery(this).data('multiple') !== true) && character_has_skill(name))
          || (!spell_circle && has_req && !meets_req(jQuery(this)))
          || (spell_circle && !has_circle_req(name))
          || (jQuery(this).data('class_skill') && !meets_class_req(jQuery(this)))
          || (limit_exceeded(jQuery(this)))) {
            jQuery(this).find('.skill_add').hide();
            jQuery(this).addClass('locked');
      } else {
        jQuery(this).find('.skill_add').show();
        jQuery(this).find('.skill_purchased').hide();
        jQuery(this).removeClass('locked');
        jQuery(this).removeClass('purchased');
      }
      jQuery(this).data('cost', cost);
    });

  }

  function limit_exceeded(skill_row){
    if(skill_row.data('max') == "" || typeof skill_row.data('max') == 'undefined'){
      return false;
    }
    if(skill_row.data('max') >= builder_data.character.skills[skill_row.data('name')]) {
      return true;
    }
    return false;
  }

  function meets_class_req(skill_row){
    level = parseInt(skill_row.data('class_level'));
    if(builder_data.character.level >= level &&
      (level == 3 || builder_data.character.last_class_skill_level >= (level-3)) &&
      skill_row.data('class') == builder_data.character.class){
      return true;
    }
    return false;
  }

  function character_has_skill(skill){
    if(builder_data.character.skills[skill] > 0){
      return true;
    }
    return false;
  }

  function is_spell_circle(skill){
    circle_search = builder_data.circles.indexOf(skill);
    if(circle_search != -1){
      return true;
    }
    return false;
  }

  function has_circle_req(skill) {
    cur_circle = builder_data.circles.indexOf(skill);
    prev_circle = builder_data.circles[cur_circle-1];
    skills = builder_data.character.skills;
    prev_skill_count = skills[prev_circle];
    cur_skill_count = skills[skill];
    if(typeof cur_skill_count == 'undefined'){
      cur_skill_count = 0;
    }
    if (cur_skill_count >= 5) {
      return false;
    } else if (skill == "Spell Slot: Ritual Base" && skills["Read Magic: Ritual"] == 1 && skills["Spell Slot: 9th Circle"] >= 1) {
      return true;
    } else if(skill == "Spell Slot: 1st Circle" && builder_data.character.spell_spheres == 1){
      return true;
    } else if (skill != "Spell Slot: 5th Circle" && skill != "Spell Slot: Ritual Base" && circle_math_req(prev_skill_count, cur_skill_count)) {
      return true;
    } else if (skill == "Spell Slot: 5th Circle" && skill != "Spell Slot: Ritual Base" && skills["Read Magic: Advanced"] == 1 && circle_math_req(prev_skill_count, cur_skill_count)){
      return true;
    }
    return false;
  }

  function circle_math_req(prev_skill_count, cur_skill_count){
    return ((prev_skill_count > (cur_skill_count+1)) || prev_skill_count == 5)
  }

  function meets_req(skill_row){
    var req = skill_row.data('requirements')
    reqs = [];

    if(typeof req !== 'undefined' && req != ""){
      items = req.split(', ');
      for (req in items) {
        items[req] = set_req_alias(items[req], skill_row.data('name'));

        if (items.hasOwnProperty(req)) {
          var conditionals = items[req].split(" OR ");
          for (subreq in conditionals) {
            if (conditionals.hasOwnProperty(subreq)) {
              reqs.push(conditionals[subreq]);
            } else {
              reqs.push(subreq);
            }
          }
        } else {
          reqs.push(req);
        }
      }

      char_skills = builder_data.character.skills;
      var returns = [];
      for (i = 0; i < reqs.length; i++) {
        if(reqs[i] == "Spell Sphere: Elemental" && char_skills["Elemental Attunement"] >=4){
          return false;
        }
        if(reqs[i] == builder_data.type_string ){
          skill_row.find('.skill_req').hide();
          returns.push(true);
        }
        if(char_skills.hasOwnProperty(reqs[i])){
          skill_row.find('.skill_req').hide();
          returns.push(true);
        }
        if(reqs[i] == "Sphere of Magic: 1st" && builder_data.character.spell_spheres > 0){
          skill_row.find('.skill_req').hide();
          returns.push(true);
        }
      }
      var unique = returns.filter(function(item, i, ar){ return ar.indexOf(item) === i; });
      if(returns.length != reqs.length){
        return false;
      }
      if(unique.length == 1 && unique[0] == true) {
        return true;
      }
    } else {
      return false;
    }
    return false;
  }

  function set_req_alias(req, skill) {
    switch(req) {
      case "Elemental Sphere":
        return "Spell Sphere: Elemental";
        break;
      case "Weapon Group Proficiency":
      case "Group Proficiency":
      console.log("GROUP");
      console.log(skill);
        switch(skill) {
          case "Critical +2: Specific Simple Weapon":
          case "Critical +2: Simple Group":
          case "Specialization +1: Simple Group":
          case "Specialization +1: Simple Weapon":
            return "Weapon Group Proficiency: Simple";
            break;
          case "Critical +2: Specific Medium Weapon":
          case "Critical +2: Medium Group":
          case "Specialization +1: Medium Group":
          case "Specialization +1: Medium Weapon":
            return "Weapon Group Proficiency: Medium";
            break;
          case "Critical +2: Specific Large Weapon":
          case "Critical +2: Large Group":
          case "Specialization +1: Large Group":
          case "Specialization +1: Large Weapon":
            return "Weapon Group Proficiency: Large";
            break;
          case "Critical +2: Specific Exotic Weapon":
          case "Critical +2: Exotic Group":
          case "Specialization +1: Exotic Group":
          case "Specialization +1: Exotic Weapon":
            return "Weapon Group Proficiency: Exotic";
            break;
          }
        case "Specialization +1: Weapon Group":
          switch(skill) {
            case "Slay / Parry: Specific Simple Weapon":
              return "Specialization +1: Simple Group"
            case "Slay / Parry: Specific Medium Weapon":
              return "Specialization +1: Medium Group"
            case "Slay / Parry: Specific Large Weapon":
              return "Specialization +1: Large Group"
            case "Slay / Parry: Specific Exotic Weapon":
              return "Specialization +1: Exotic Group"
          }
        case "Specialization +1: Weapon Specific":
          switch(skill) {
            case "Slay / Parry":
              return "Specialization +1: Simple Weapon"
          }
      case "Critical +2: Specific":
        switch(skill) {
          case "Execute: Specific Simple Weapon":
            return "Critical +2: Specific Simple Weapon";
            break;
          case "Execute: Specific Medium Weapon":
            return "Critical +2: Specific Medium Weapon";
            break;
          case "Execute: Specific Large Weapon":
            return "Critical +2: Specific Large Weapon";
            break;
          case "Execute: Specific Exotic Weapon":
            return "Critical +2: Specific Exotic Weapon";
            break;
        }
      case "Critical +2: Group":
        switch(skill) {
          case "Execute: Simple Weapon Group":
            return "Critical +2: Simple Group";
            break;
          case "Execute: Medium Weapon Group":
            return "Critical +2: Medium Group";
            break;
          case "Execute: Large Weapon Group":
            return "Critical +2: Large Group";
            break;
          case "Execute: Exotic Weapon Group":
            return "Critical +2: Exotic Group";
            break;
        }
      case "Execute":
        switch(skill) {
          case "Execute: Specific Simple Weapon (Subsequent)":
            return "Execute: Specific Simple Weapon";
            break;
          case "Execute: Specific Medium Weapon (Subsequent)":
            return "Execute: Specific Medium Weapon";
            break;
          case "Execute: Specific Large Weapon (Subsequent)":
            return "Execute: Specific Large Weapon";
            break;
          case "Execute: Specific Exotic Weapon (Subsequent)":
            return "Execute: Specific Exotic Weapon";
            break;
        }

    }
    return req;
  }

  function reset_skills(){

    builder_data.character.skill_count = 0;
    jQuery('#cb_skill_count').html(0);
    jQuery('.skill_row').removeClass('locked');
    jQuery('.skill_row').removeClass('purchased');
    jQuery('.skill_req').show();
    jQuery('.skill_add').show();
    jQuery('.skill_purchased').hide();
  }

  function update_spell_spheres(){
    builder_data.character.spell_spheres++;
    if(builder_data.character.spell_spheres == 3) {
      jQuery('.spell_sphere').addClass('purchased');
    }
  }

  jQuery('.btn-cb-content ').on('click', function(){
    jQuery('.btn-cb-content').toggleClass('active');
    jQuery('.cb_display_content').toggleClass('active');
  });

  jQuery('.legend_toggler').on('click', function(e){
    e.preventDefault();
    jQuery('#legend').toggleClass('opened').toggleClass('closed');
  });

  jQuery('#btn_data_export, #btn_data_import').on('click', function(e){
    e.preventDefault();
    jQuery('.non_data_fields').hide();
    jQuery('#cb_selectors').hide();
    jQuery('#data_fields').show();
  });
  jQuery('#btn_data_export').on('click', function(e){
    e.preventDefault();
    jQuery('#data_fields_export').show();
    jQuery('#data_fields_import').hide();
  });
  jQuery('#btn_data_import').on('click', function(e){
    e.preventDefault();
    jQuery('#data_fields_export').hide();
    jQuery('#data_fields_import').show();
  });

  jQuery('#btn_close_data').on('click', function(e){
    e.preventDefault();
    if(builder_data.character['skill_count'] == 0){
      jQuery('#btn_reset').trigger('click');
    } else {
      jQuery('.non_data_fields').show();
      jQuery('#data_fields').hide();
      jQuery('#char_export_code').val("");
      jQuery('#data_import').val("");
      jQuery('.mandatory_section').show();
      jQuery('#btn_generate').hide();
      jQuery('#cb_selectors').hide();
    }
  });

  jQuery('#generate_export').on('click', function(e){
    e.preventDefault();
    jQuery('#char_export_code').val(JSON.stringify(builder_data.character));
  });

  jQuery('#save_character').on('click', function(){
    localStorage.setItem('saved_character', JSON.stringify(builder_data.character));
    jQuery('#load_character_section').show();
    if(builder_data.character['skill_count'] == 0){
      jQuery('#btn_reset').trigger('click');
    } else {
      jQuery('.non_data_fields').show();
      jQuery('#data_fields').hide();
      jQuery('#char_export_code').val("");
      jQuery('#data_import').val("");
      jQuery('.mandatory_section').show();
      jQuery('#btn_generate').hide();
      jQuery('#cb_selectors').hide();
    }
  });

  jQuery('#load_character').on('click', function(){
    saved_char = localStorage.getItem('saved_character');
    parsed_char = JSON.parse(saved_char);
    load_character(parsed_char);
  });

  jQuery('#process_import').on('click', function(e){
    e.preventDefault();
    var char_import = jQuery('#data_import').val();
    var parsed_char = JSON.parse(char_import);
    load_character(parsed_char)
  });

  function load_character(character){

    builder_data.character = character;

    jQuery('.non_data_fields').show();
    jQuery('#data_fields').hide();
    jQuery('#char_export_code').val("");
    jQuery('#data_import').val("");
    jQuery('.mandatory_section').show();
    jQuery('#btn_generate').hide();
    jQuery('#cb_selectors').hide();
    jQuery("#cb-class").val(builder_data.character.class);
    jQuery("#cb-race").val(builder_data.character.race);

    update_character();
    update_skills();

  }

  // Cache selectors outside callback for performance.
  var $window = jQuery(window),
      $stickyEl = jQuery('#character_data'),
      elTop = $stickyEl.offset().top;

  $window.scroll(function() {
    if(!jQuery('header#header').hasClass('mobile')){
       $stickyEl.toggleClass('sticky', $window.scrollTop() > elTop);
     }
  });

  $stickyEl.css({'max-width': $stickyEl.width()});
  $stickyEl.css({'width': $stickyEl.width()});

  if(typeof saved_char !== 'undefined'){
    jQuery('#load_character_section').show();
  }



  jQuery('#btn_choose_race').on('click', function(){
    jQuery('#menu_items').hide();
    jQuery('#menu_launcher').css('background', 'none');
    jQuery('#menu_launcher').css('padding-top', '0');
    jQuery('#race_selector').fadeIn();
    scrollTo(jQuery('#selector_elements'));

  });
  jQuery('#btn_choose_class').on('click', function(){
    jQuery('#menu_items').hide();
    jQuery('#menu_launcher').css('background', 'none');
    jQuery('#menu_launcher').css('padding-top', '0');
    jQuery('#class_selector').fadeIn();
    scrollTo(jQuery('#selector_elements'));
  });

  function scrollTo(ele) {

    jQuery('html, body').animate({
        scrollTop: ele.offset().top
    }, 300);

  }

  jQuery('.builder_selector').on('change', function(){
    jQuery('.content').hide();
    jQuery('.content[data-name="'+jQuery(this).val()+'"]').fadeIn();
  });

  jQuery('#category-dropdown').on('change', function(){
    builder_data.character.category = jQuery(this).val();
  });


  jQuery(document).on('click', '#select_race', function(){
    jQuery('#btn_choose_race').addClass('selected');
    jQuery('#menu_items').fadeIn();
    jQuery('#menu_launcher').css('background', '');
    jQuery('#menu_launcher').css('padding-top', '');
    jQuery('#race_selector').hide();
    set_race(jQuery(this).data('race'), jQuery(this).data('frag_cost'));
  });
  jQuery(document).on('click', '#select_class', function(){
    jQuery('#btn_choose_class').addClass('selected');
    jQuery('#menu_items').fadeIn();
    jQuery('#menu_launcher').css('background', '');
    jQuery('#menu_launcher').css('padding-top', '');
    jQuery('#class_selector').hide();
    set_class(jQuery(this).data('class'), jQuery(this).data('frag_cost'), jQuery(this).data('cost-ele'));
  });
  jQuery(document).on('click', '#select_occupation', function(){
    set_occupation(jQuery(this).data('class'), jQuery(this).data('cost-ele'));
  });
  jQuery(document).on('click', '#select_vocation', function(){
    set_vocation(jQuery(this).data('class'), jQuery(this).data('cost-ele'));
  });

});
