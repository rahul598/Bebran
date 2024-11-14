<style>
:root {
  /* fonts */
  --font-montserrat: Montserrat;

  /* font sizes */
  --font-size-mini: 15px;
  --font-size-sm: 14px;
  --font-size-smi: 13px;
  --font-size-mid: 17px;
  --font-size-3xs: 10px;
  --font-size-3xl: 22px;
  --font-size-5xs: 8px;
  --font-size-xl: 20px;
  --font-size-base: 16px;
  --font-size-3xs-1: 9.1px;
  --font-size-xs-4: 11.4px;

  /* Colors */
  --color-white: #fff;
  --color-mediumseagreen: #24bd61;
  --color-gray-100: #1a1717;
  --color-gray-200: rgba(251, 251, 251, 0.8);
  --color-black: #000;
  --color-lavender-100: #dadeff;
  --color-lavender-200: #ced1e1;
  --color-darkslateblue-100: #5966b8;
  --color-darkslateblue-200: #343f92;
  --color-darkslateblue-300: #181e4e;
  --color-darkslateblue-400: rgba(24, 30, 78, 0.2);
  --color-darkslateblue-500: rgba(89, 102, 184, 0.09);
  --color-darkorange: #ff7613;
  --color-lemonchiffon: #fef3c7;
  --color-gold: #facc16;
  --color-ghostwhite: #eef0fd;

  /* Gaps */
  --gap-5xl: 24px;
  --gap-xl: 20px;
  --gap-lgi: 19px;
  --gap-smi: 13px;
  --gap-7xs-5: 5.5px;
  --gap-5xs: 8px;
  --gap-12xs-9: 0.9px;

  /* Paddings */
  --padding-11xs: 2px;
  --padding-10xs-4: 2.4px;
  --padding-xl: 20px;
  --padding-12xs: 1px;
  --padding-lg: 18px;
  --padding-7xl: 26px;
  --padding-mid: 17px;
  --padding-12xl: 31px;
  --padding-sm: 14px;
  --padding-6xs: 7px;
  --padding-5xs: 8px;
  --padding-8xl-1: 27.1px;
  --padding-7xs: 6px;
  --padding-smi: 13px;
  --padding-8xs: 5px;
  --padding-5xs-1: 7.1px;
  --padding-8xl: 27px;
  --padding-3xs: 10px;
  --padding-9xs-4: 3.4px;
  --padding-4xs-6: 8.6px;
  --padding-2xs: 11px;

  /* Border radiuses */
  --br-7xs: 6px;
  --br-xl: 20px;
  --br-3xs: 10px;
  --br-7xs-7: 5.7px;
}
.compare-all-features {
  margin: 0;
  position: relative;
  font-size: inherit;
  font-weight: 700;
  font-family: inherit;
}
.plan-comparison {
  display: flex;
  flex-direction: row;
  align-items: flex-start;
  justify-content: flex-start;
  padding: 0 var(--padding-12xs);
}
.subscription-options-child,
.text-1-child {
  position: relative;
  border-radius: var(--br-7xs-7);
  display: none;
}
.subscription-options-child {
  height: 51.4px;
  width: 392px;
  border: 1.1px solid var(--color-darkslateblue-400);
  box-sizing: border-box;
  max-width: 100%;
}
.text-1-child {
  width: 86.9px;
  height: 44.6px;
  background-color: var(--color-ghostwhite);
}
.month,
.monthly {
  position: relative;
  display: inline-block;
  z-index: 1;
}
.monthly {
  align-self: stretch;
  font-weight: 500;
  min-width: 48.2px;
}
.month {
  min-width: 37px;
  white-space: nowrap;
}
.monthly-duration-details {
  display: flex;
  flex-direction: row;
  align-items: flex-start;
  justify-content: flex-end;
  padding: 0 5.5px 0 var(--padding-7xs);
  font-size: var(--font-size-3xs-1);
}
.text-1 {
  width: 86.9px;
  border-radius: var(--br-7xs-7);
  background-color: var(--color-ghostwhite);
  display: flex;
  flex-direction: column;
  align-items: flex-end;
  justify-content: flex-start;
  padding: 9.2px 20.4px var(--padding-4xs-6) 18.3px;
  box-sizing: border-box;
  gap: var(--gap-12xs-9);
  z-index: 1;
}
.month1,
.quarterly {
  position: relative;
  display: inline-block;
  flex-shrink: 0;
  debug_commit: 1de1738;
  z-index: 1;
}
.quarterly {
  align-self: stretch;
  font-weight: 500;
  min-width: 55.2px;
}
.month1 {
  flex: 1;
  min-width: 38.6px;
}
.month-duration {
  align-self: stretch;
  display: flex;
  flex-direction: row;
  align-items: flex-start;
  justify-content: flex-start;
  padding: 0 9px 0 var(--padding-5xs);
  font-size: var(--font-size-3xs-1);
}
.duration-labels,
.plan-duration {
  display: flex;
  flex-direction: column;
  align-items: flex-start;
}
.duration-labels {
  align-self: stretch;
  justify-content: flex-start;
  gap: var(--gap-12xs-9);
}
.plan-duration {
  width: 66.2px;
  justify-content: flex-end;
  padding: 0 var(--padding-2xs) 9.4px 0;
  box-sizing: border-box;
}
.half-yearly,
.month2 {
  position: relative;
  display: inline-block;
  z-index: 1;
}
.half-yearly {
  align-self: stretch;
  font-weight: 500;
  min-width: 61.1px;
}
.month2 {
  min-width: 39px;
}
.month-wrapper {
  display: flex;
  flex-direction: row;
  align-items: flex-start;
  justify-content: flex-end;
  padding: 0 10.7px 0 var(--padding-2xs);
  font-size: var(--font-size-3xs-1);
}
.half-yearly-parent {
  align-self: stretch;
  display: flex;
  flex-direction: column;
  align-items: flex-end;
  justify-content: flex-start;
  gap: var(--gap-12xs-9);
}
.plan-duration1 {
  width: 80px;
  display: flex;
  flex-direction: column;
  align-items: flex-start;
  justify-content: flex-end;
  padding: 0 18.9px var(--padding-4xs-6) 0;
  box-sizing: border-box;
}
.yearly {
  position: relative;
  font-weight: 500;
  display: inline-block;
  min-width: 35px;
  flex-shrink: 0;
  debug_commit: 1de1738;
  z-index: 1;
}
.yearly-wrapper {
  display: flex;
  flex-direction: row;
  align-items: flex-start;
  justify-content: flex-start;
  padding: 0 4px 0 var(--padding-9xs-4);
}
.month3 {
  position: relative;
  font-size: var(--font-size-3xs-1);
  display: inline-block;
  min-width: 42px;
  flex-shrink: 0;
  debug_commit: 1de1738;
  z-index: 1;
}
.yearly-plan-content,
.yearly-plan-details {
  display: flex;
  flex-direction: column;
  align-items: flex-start;
  justify-content: flex-start;
}
.yearly-plan-details {
  justify-content: flex-end;
  padding: 0 0 var(--padding-4xs-6);
}
.subscription-options {
  margin: 0;
  align-self: stretch;
  border-radius: var(--br-7xs-7);
  border: 1.1px solid var(--color-darkslateblue-400);
  box-sizing: border-box;
  display: flex;
  flex-direction: row;
  flex-wrap: wrap;
  align-items: flex-end;
  justify-content: space-between;
  padding: var(--padding-11xs) 28px var(--padding-11xs) var(--padding-9xs-4);
  max-width: 100%;
  gap: var(--gap-xl);
  white-space: nowrap;
  text-align: center;
  font-size: var(--font-size-xs-4);
  color: var(--color-black);
  font-family: var(--font-montserrat);
}
.main-content,
.plan-comparison-parent {
  display: flex;
  align-items: flex-start;
  max-width: 100%;
}
.plan-comparison-parent {
  width: 392px;
  flex-direction: column;
  justify-content: flex-start;
  gap: 39px;
}
.main-content {
  align-self: stretch;
  flex-direction: row;
  justify-content: center;
  padding: 0 0 0 var(--padding-11xs);
  text-align: center;
  font-size: 35px;
  color: var(--color-darkslateblue-300);
  font-family: var(--font-montserrat);
}
.border,
.cta:hover,
.main-content {
  box-sizing: border-box;
}
.border,
.box-01-child {
  width: 210px;
  height: 162px;
  position: relative;
  border-radius: var(--br-7xs);
  border: 0.7px solid var(--color-lavender-200);
  display: none;
}
.box-01-child {
  width: 257.9px;
  height: 77px;
  border-radius: var(--br-3xs);
  border: 1px solid var(--color-lavender-200);
  box-sizing: border-box;
}
.lite {
  position: relative;
  font-weight: 600;
  display: inline-block;
  min-width: 39.1px;
  z-index: 1;
}
.plan-types {
  display: flex;
  flex-direction: row;
  align-items: flex-start;
  justify-content: flex-start;
  padding: 0 53px 0 54px;
}
.div {
  position: absolute;
  top: 0;
  left: 0;
  display: inline-block;
  width: 55px;
  min-width: 55px;
  white-space: nowrap;
  z-index: 1;
}
.price-divider {
  position: absolute;
  top: 9px;
  left: 2px;
  border-top: 1px solid var(--color-black);
  box-sizing: border-box;
  width: 56.2px;
  height: 1px;
  z-index: 2;
}
.price-labels {
  height: 18px;
  flex: 1;
  position: relative;
}
.frame-child {
  height: 16px;
  width: 53.2px;
  position: relative;
  border-radius: var(--br-xl);
  background-color: var(--color-lemonchiffon);
  border: 1px solid var(--color-gold);
  box-sizing: border-box;
  display: none;
}
.save-30 {
  position: relative;
  font-weight: 600;
  display: inline-block;
  min-width: 39.1px;
  z-index: 2;
}
.rectangle-parent {
  flex: 0.7368;
  border-radius: var(--br-xl);
  background-color: var(--color-lemonchiffon);
  border: 1px solid var(--color-gold);
  padding: var(--padding-12xs) var(--padding-8xs) var(--padding-12xs)
    var(--padding-6xs);
  white-space: nowrap;
  z-index: 1;
  font-size: var(--font-size-5xs);
}
.price-details,
.price-details-wrapper,
.rectangle-parent {
  display: flex;
  flex-direction: row;
  align-items: flex-start;
  justify-content: flex-start;
}
.price-details {
  flex: 1;
  gap: 9px;
}
.price-details-wrapper {
  align-self: stretch;
  padding: 0 var(--padding-smi) 0 var(--padding-sm);
  font-size: var(--font-size-mini);
  color: var(--color-black);
}
.span {
  font-weight: 600;
}
.month5 {
  font-size: var(--font-size-sm);
  font-weight: 500;
  color: var(--color-black);
}
.month4 {
  position: relative;
  z-index: 1;
  font-size: var(--font-size-3xl);
  color: var(--color-darkorange);
}
.plan-features-labels {
  align-self: stretch;
  display: flex;
  flex-direction: column;
  align-items: flex-start;
  justify-content: flex-start;
  gap: var(--gap-7xs-5);
}
.cta-child {
  height: 32px;
  width: 131.4px;
  position: relative;
  border-radius: var(--br-7xs);
  border: 1px solid var(--color-darkslateblue-200);
  box-sizing: border-box;
  display: none;
}
.subscribe-now {
  position: relative;
  font-size: var(--font-size-3xs);
  font-weight: 600;
  font-family: var(--font-montserrat);
  color: var(--color-darkslateblue-200);
  text-align: left;
  display: inline-block;
  min-width: 78.3px;
  z-index: 1;
}
.cta,
.cta-wrapper {
  display: flex;
  flex-direction: row;
  align-items: flex-start;
}
.cta {
  cursor: pointer;
  border: 1px solid var(--color-darkslateblue-200);
  padding: var(--padding-5xs) var(--padding-7xl) var(--padding-5xs)
    var(--padding-8xl-1);
  background-color: transparent;
  border-radius: var(--br-7xs);
  justify-content: flex-start;
  white-space: nowrap;
  z-index: 1;
}
.cta:hover {
  background-color: var(--color-darkslateblue-500);
  border: 1px solid var(--color-darkslateblue-100);
}
.cta-wrapper {
  justify-content: flex-end;
  padding: 0 var(--padding-5xs-1) 0 var(--padding-5xs);
}
.box-01,
.box-01-wrapper {
  display: flex;
  flex-direction: column;
  justify-content: flex-start;
}
.box-01 {
  align-self: stretch;
  border-radius: var(--br-7xs);
  border: 0.7px solid var(--color-lavender-200);
  align-items: flex-end;
  padding: var(--padding-lg) var(--padding-12xl) var(--padding-mid);
  gap: var(--gap-smi);
}
.box-01-wrapper {
  flex: 1;
  align-items: flex-start;
  padding: 0 5.1px 0 0;
  box-sizing: border-box;
  min-width: 142px;
}
.border1 {
  width: 210px;
  height: 162px;
  position: relative;
  box-shadow: 0 2px 6px #343f92;
  border-radius: var(--br-7xs);
  background-color: var(--color-darkslateblue-200);
  display: none;
}
.standard {
  position: relative;
  font-weight: 600;
  display: inline-block;
  min-width: 95px;
  z-index: 1;
}
.standard-wrapper {
  display: flex;
  flex-direction: row;
  align-items: flex-start;
  justify-content: flex-start;
  padding: 0 21px;
}
.div1 {
  position: absolute;
  top: 0;
  left: 0;
  display: inline-block;
  min-width: 59px;
  white-space: nowrap;
  width: 100%;
  height: 100%;
  z-index: 1;
}
.button-divider {
  position: absolute;
  top: 9px;
  left: 3px;
  border-top: 1px solid var(--color-white);
  box-sizing: border-box;
  width: 56px;
  height: 1px;
  z-index: 2;
}
.parent {
  height: 18px;
  flex: 1;
  position: relative;
}
.secondary-plan-button-child {
  height: 16px;
  width: 53px;
  position: relative;
  border-radius: var(--br-xl);
  background-color: var(--color-gray-200);
  border: 1px solid var(--color-white);
  box-sizing: border-box;
  display: none;
}
.save-301 {
  position: relative;
  font-weight: 600;
  display: inline-block;
  min-width: 39px;
  z-index: 2;
}
.secondary-plan-button {
  flex: 0.7358;
  border-radius: var(--br-xl);
  background-color: var(--color-gray-200);
  border: 1px solid var(--color-white);
  padding: var(--padding-12xs) var(--padding-7xs);
  white-space: nowrap;
  z-index: 1;
  font-size: var(--font-size-5xs);
  color: var(--color-black);
}
.frame-group,
.frame-wrapper,
.secondary-plan-button {
  display: flex;
  flex-direction: row;
  align-items: flex-start;
  justify-content: flex-start;
}
.frame-group {
  flex: 1;
  gap: var(--gap-5xs);
}
.frame-wrapper {
  width: 133px;
  padding: 0 var(--padding-6xs);
  box-sizing: border-box;
  font-size: var(--font-size-mini);
}
.span1 {
  font-weight: 600;
}
.month7 {
  font-size: var(--font-size-sm);
  font-weight: 500;
}
.month6 {
  position: relative;
  color: #666;
  z-index: 1;
  font-size: var(--font-size-3xl);
}
.frame-parent {
  display: flex;
  flex-direction: column;
  align-items: flex-start;
  justify-content: flex-start;
  gap: var(--gap-7xs-5);
}
.cta-item {
  height: 32px;
  width: 131px;
  position: relative;
  border-radius: var(--br-7xs);
  background-color: var(--color-lavender-100);
  display: none;
}
.subscribe-now1 {
  position: relative;
  font-size: var(--font-size-3xs);
  font-weight: 600;
  font-family: var(--font-montserrat);
  color: #111;
  text-align: left;
  display: inline-block;
  min-width: 78px;
  z-index: 1;
}
.cta1 {
  cursor: pointer;
  border: 0;
  padding: var(--padding-3xs) var(--padding-7xl) var(--padding-3xs)
    var(--padding-8xl);
  background-color: var(--color-lavender-100);
  border-radius: var(--br-7xs);
  flex-direction: row;
  white-space: nowrap;
  z-index: 1;
}
.cta1:hover {
  background-color: #bfc4e6;
}
.box-02,
.cta-container,
.cta1 {
  display: flex;
  align-items: flex-start;
  justify-content: flex-start;
}
.cta-container {
  flex-direction: row;
  padding: 0 3px;
}
.box-02 {
  box-shadow: 0 2px 6px #343f92;
  border-radius: var(--br-7xs);
  background-color: var(--color-darkslateblue-200);
  flex-direction: column;
  padding: 19px 24px var(--padding-lg) 38px;
  gap: 12px;
  color: var(--color-white);
}
.border2,
.box-03-child {
  width: 210px;
  height: 162px;
  position: relative;
  border-radius: var(--br-7xs);
  border: 0.7px solid var(--color-lavender-200);
  box-sizing: border-box;
  display: none;
}
.box-03-child {
  width: 257.9px;
  height: 77px;
  border-radius: var(--br-3xs);
  border: 1px solid var(--color-lavender-200);
}
.advance {
  flex: 1;
  position: relative;
  font-weight: 600;
  display: inline-block;
  min-width: 92px;
  z-index: 1;
}
.advance-wrapper {
  align-self: stretch;
  display: flex;
  flex-direction: row;
  align-items: flex-start;
  justify-content: flex-start;
  padding: 0 var(--padding-8xl);
}
.div2 {
  position: absolute;
  top: 0;
  left: 0;
  display: inline-block;
  width: 100%;
  min-width: 59px;
  white-space: nowrap;
  height: 100%;
  z-index: 1;
}
.frame-item {
  position: absolute;
  top: 9px;
  left: 3px;
  border-top: 1px solid var(--color-black);
  box-sizing: border-box;
  width: 56.2px;
  height: 1px;
  z-index: 2;
}
.group {
  height: 18px;
  flex: 1;
  position: relative;
}
.frame-inner {
  height: 16px;
  width: 53.2px;
  position: relative;
  border-radius: var(--br-xl);
  background-color: var(--color-lemonchiffon);
  border: 1px solid var(--color-gold);
  box-sizing: border-box;
  display: none;
}
.save-302 {
  position: relative;
  font-weight: 600;
  display: inline-block;
  min-width: 39.1px;
  z-index: 2;
}
.rectangle-group {
  flex: 0.735;
  border-radius: var(--br-xl);
  background-color: var(--color-lemonchiffon);
  border: 1px solid var(--color-gold);
  padding: var(--padding-12xs) var(--padding-8xs) var(--padding-12xs)
    var(--padding-5xs-1);
  white-space: nowrap;
  z-index: 1;
  font-size: var(--font-size-5xs);
}
.frame-div,
.frame-parent1,
.rectangle-group {
  display: flex;
  flex-direction: row;
  align-items: flex-start;
  justify-content: flex-start;
}
.frame-parent1 {
  flex: 1;
  gap: var(--gap-5xs);
}
.frame-div {
  align-self: stretch;
  padding: 0 var(--padding-sm) 0 var(--padding-smi);
  text-align: left;
  font-size: var(--font-size-mini);
  color: var(--color-black);
}
.span2 {
  font-weight: 600;
}
.month9 {
  font-size: var(--font-size-sm);
  font-weight: 500;
  color: var(--color-black);
}
.month8 {
  align-self: stretch;
  position: relative;
  z-index: 1;
  font-size: var(--font-size-3xl);
  color: var(--color-darkorange);
}
.frame-container {
  align-self: stretch;
  display: flex;
  flex-direction: column;
  align-items: flex-start;
  justify-content: flex-start;
  gap: var(--gap-7xs-5);
}
.cta-inner {
  height: 32px;
  width: 131.4px;
  position: relative;
  border-radius: var(--br-7xs);
  border: 1px solid var(--color-darkslateblue-200);
  box-sizing: border-box;
  display: none;
}
.subscribe-now2 {
  position: relative;
  font-size: var(--font-size-3xs);
  font-weight: 600;
  font-family: var(--font-montserrat);
  color: var(--color-darkslateblue-200);
  text-align: left;
  display: inline-block;
  min-width: 78.3px;
  z-index: 1;
}
.cta2 {
  cursor: pointer;
  border: 1px solid var(--color-darkslateblue-200);
  padding: var(--padding-5xs) var(--padding-7xl) var(--padding-5xs)
    var(--padding-8xl-1);
  background-color: transparent;
  border-radius: var(--br-7xs);
  flex-direction: row;
  white-space: nowrap;
  z-index: 1;
}
.cta2:hover,
.cta3:hover {
  background-color: var(--color-darkslateblue-500);
  border: 1px solid var(--color-darkslateblue-100);
  box-sizing: border-box;
}
.box-03,
.box-03-wrapper,
.cta-frame,
.cta2 {
  display: flex;
  align-items: flex-start;
  justify-content: flex-start;
}
.cta-frame {
  flex-direction: row;
  padding: 0 var(--padding-5xs) 0 var(--padding-6xs);
}
.box-03,
.box-03-wrapper {
  flex-direction: column;
}
.box-03 {
  align-self: stretch;
  border-radius: var(--br-7xs);
  border: 0.7px solid var(--color-lavender-200);
  padding: var(--padding-lg) var(--padding-12xl) var(--padding-mid);
  gap: var(--gap-smi);
}
.box-03-wrapper {
  flex: 0.9859;
  padding: 0 8.1px 0 0;
  box-sizing: border-box;
  min-width: 142px;
  text-align: center;
}
.border3,
.box-04-child {
  width: 210px;
  height: 162px;
  position: relative;
  border-radius: var(--br-7xs);
  border: 0.7px solid var(--color-lavender-200);
  box-sizing: border-box;
  display: none;
}
.box-04-child {
  width: 257.9px;
  height: 77px;
  border-radius: var(--br-3xs);
  border: 1px solid var(--color-lavender-200);
}
.enterprise {
  flex: 1;
  position: relative;
  font-weight: 600;
  z-index: 1;
}
.enterprise-wrapper {
  align-self: stretch;
  display: flex;
  flex-direction: row;
  align-items: flex-start;
  justify-content: flex-end;
  padding: 0 1.4px 0 var(--padding-11xs);
}
.lakh,
.line-div {
  position: absolute;
}
.lakh {
  top: 0;
  left: 0;
  display: inline-block;
  width: 100%;
  min-width: 59.2px;
  height: 100%;
  z-index: 1;
}
.line-div {
  top: 9px;
  left: 3px;
  border-top: 1px solid var(--color-black);
  box-sizing: border-box;
  width: 56.2px;
  height: 1px;
  z-index: 2;
}
.lakh-parent {
  height: 18px;
  flex: 1;
  position: relative;
}
.savings-detail-child {
  height: 16px;
  width: 53.2px;
  position: relative;
  border-radius: var(--br-xl);
  background-color: var(--color-lemonchiffon);
  border: 1px solid var(--color-gold);
  box-sizing: border-box;
  display: none;
}
.save-303 {
  position: relative;
  font-weight: 600;
  display: inline-block;
  min-width: 39.1px;
  z-index: 2;
}
.frame-parent3,
.savings-detail {
  flex-direction: row;
  align-items: flex-start;
}
.savings-detail {
  flex: 0.735;
  border-radius: var(--br-xl);
  background-color: var(--color-lemonchiffon);
  border: 1px solid var(--color-gold);
  display: flex;
  justify-content: flex-start;
  padding: var(--padding-12xs) var(--padding-8xs) var(--padding-12xs)
    var(--padding-5xs-1);
  white-space: nowrap;
  z-index: 1;
  font-size: var(--font-size-5xs);
}
.frame-parent3 {
  align-self: stretch;
  gap: 7px;
  text-align: left;
  font-size: var(--font-size-mini);
  color: var(--color-black);
}
.box-04-inner,
.frame-parent2,
.frame-parent3 {
  display: flex;
  justify-content: flex-start;
}
.frame-parent2 {
  flex: 1;
  flex-direction: column;
  align-items: flex-end;
  gap: 5px;
}
.box-04-inner {
  align-self: stretch;
  flex-direction: row;
  align-items: flex-start;
  padding: 0 var(--padding-xl) 0 var(--padding-smi);
}
.span3 {
  font-weight: 600;
}
.month11 {
  font-size: var(--font-size-sm);
  font-weight: 500;
  color: var(--color-black);
}
.month10 {
  position: relative;
  z-index: 1;
}
.month-container {
  display: flex;
  flex-direction: row;
  align-items: flex-start;
  justify-content: flex-start;
  padding: 0 0 var(--padding-7xs);
  font-size: var(--font-size-3xl);
  color: var(--color-darkorange);
}
.rectangle-div {
  height: 32px;
  width: 131.4px;
  position: relative;
  border-radius: var(--br-7xs);
  border: 1px solid var(--color-darkslateblue-200);
  box-sizing: border-box;
  display: none;
}
.subscribe-now3 {
  position: relative;
  font-size: var(--font-size-3xs);
  font-weight: 600;
  font-family: var(--font-montserrat);
  color: var(--color-darkslateblue-200);
  text-align: left;
  display: inline-block;
  min-width: 78.3px;
  z-index: 1;
}
.box-04,
.cta-wrapper1,
.cta3 {
  display: flex;
  flex-direction: row;
  align-items: flex-start;
  justify-content: flex-start;
}
.cta3 {
  cursor: pointer;
  border: 1px solid var(--color-darkslateblue-200);
  padding: var(--padding-5xs) var(--padding-7xl) var(--padding-5xs)
    var(--padding-8xl-1);
  background-color: transparent;
  border-radius: var(--br-7xs);
  white-space: nowrap;
  z-index: 1;
}
.box-04,
.cta-wrapper1 {
  padding: 0 var(--padding-sm) 0 var(--padding-6xs);
}
.box-04 {
  flex: 0.7394;
  border-radius: var(--br-7xs);
  border: 0.7px solid var(--color-lavender-200);
  box-sizing: border-box;
  flex-direction: column;
  padding: var(--padding-lg) var(--padding-7xl) var(--padding-mid)
    var(--padding-12xl);
  gap: 6px;
  min-width: 136px;
  text-align: center;
}
.feature-comparison-table,
.plan-features {
  display: flex;
  flex-direction: row;
  align-items: flex-start;
  max-width: 100%;
}
.feature-comparison-table {
  width: 921.9px;
  justify-content: center;
  gap: 22.9px;
}
.plan-features {
  align-self: stretch;
  justify-content: flex-end;
}
.on-boarding {
  width: 114.4px;
  position: relative;
  display: inline-block;
  min-width: 114.4px;
}
.whatsapp-group-creation {
  align-self: stretch;
  position: relative;
  font-size: var(--font-size-sm);
  text-align: left;
}
.onboarding-steps {
  width: 239px;
  display: flex;
  flex-direction: column;
  align-items: flex-start;
  justify-content: flex-start;
  gap: 23px;
}
.send-welcome {
  position: relative;
}
.whatsapp-group-creation1 {
  width: 239px;
  position: relative;
  line-height: 14px;
  display: inline-block;
}
.welcome-process {
  display: flex;
  flex-direction: column;
  align-items: flex-start;
  justify-content: flex-start;
  gap: 21px;
  text-align: left;
  font-size: var(--font-size-sm);
  color: var(--color-black);
}
.clients-sidepay-seperately {
  position: relative;
}
.client-payment {
  display: flex;
  flex-direction: column;
  align-items: flex-start;
  justify-content: flex-start;
  padding: var(--padding-12xs) 0 0;
}
.clients-sidepay-seperately1 {
  position: relative;
}
.client-payment-steps,
.client-payment1 {
  display: flex;
  align-items: flex-start;
  justify-content: flex-start;
}
.client-payment1 {
  flex-direction: column;
  padding: var(--padding-12xs) 0 0;
}
.client-payment-steps {
  align-self: stretch;
  flex-direction: row;
  gap: 49px;
}
.business-understanding {
  flex: 1;
  position: relative;
}
.business-step,
.process-steps {
  display: flex;
  align-items: flex-start;
  justify-content: flex-start;
}
.business-step {
  width: 222.7px;
  flex-direction: row;
  padding: 0 var(--padding-11xs);
  box-sizing: border-box;
  font-size: var(--font-size-mid);
  color: var(--color-black);
}
.process-steps {
  flex: 1;
  flex-direction: column;
  gap: 31.4px;
  min-width: 474px;
  max-width: 100%;
}
.clients-sidepay-seperately2 {
  position: relative;
}
.additional-steps {
  display: flex;
  flex-direction: column;
  align-items: flex-start;
  justify-content: flex-start;
  padding: var(--padding-12xs) 0 0;
}
.onboarding-process,
.onboarding-steps-parent {
  display: flex;
  align-items: flex-start;
  justify-content: flex-start;
  max-width: 100%;
}
.onboarding-process {
  align-self: stretch;
  flex-direction: row;
  flex-wrap: wrap;
  gap: 60px;
  font-size: var(--font-size-smi);
  color: var(--color-gray-100);
}
.onboarding-steps-parent {
  width: 969px;
  flex-direction: column;
  gap: var(--gap-lgi);
  text-align: center;
  font-size: var(--font-size-mid);
  color: var(--color-black);
}
.whatsapp-group-creation2,
.whatsapp-group-creation3 {
  align-self: stretch;
  position: relative;
  flex-shrink: 0;
  debug_commit: 1de1738;
}
.whatsapp-group-creation3 {
  line-height: 13.2px;
}
.communication-channels {
  width: 191.8px;
  display: flex;
  flex-direction: column;
  align-items: flex-start;
  justify-content: flex-start;
  gap: 22.4px;
  font-size: var(--font-size-sm);
  color: var(--color-black);
}
.item-descriptions {
  position: relative;
  font-weight: 500;
  display: inline-block;
  min-width: 6px;
}
.feature-items {
  width: 26.8px;
  display: flex;
  flex-direction: column;
  align-items: flex-start;
  justify-content: flex-start;
  padding: var(--padding-10xs-4) var(--padding-xl) 0 0;
  box-sizing: border-box;
}
.div3 {
  position: relative;
  font-weight: 500;
  display: inline-block;
  min-width: 9px;
}
.feature-items1 {
  width: 32.8px;
  display: flex;
  flex-direction: column;
  align-items: flex-start;
  justify-content: flex-start;
  padding: var(--padding-10xs-4) var(--padding-xl) 0 0;
  box-sizing: border-box;
}
.div4 {
  position: relative;
  font-weight: 500;
  display: inline-block;
  min-width: 9px;
}
.feature-items2 {
  width: 38.8px;
  display: flex;
  flex-direction: column;
  align-items: flex-start;
  justify-content: flex-start;
  padding: var(--padding-10xs-4) var(--padding-xl) 0 0;
  box-sizing: border-box;
}
.div5 {
  position: relative;
  font-weight: 500;
  display: inline-block;
  min-width: 11px;
}
.feature-items3,
.feature-list {
  display: flex;
  align-items: flex-start;
}
.feature-items3 {
  flex-direction: column;
  justify-content: flex-start;
  padding: var(--padding-10xs-4) 0 0;
}
.feature-list {
  flex: 1;
  flex-direction: row;
  justify-content: space-between;
  max-width: 100%;
  gap: var(--gap-xl);
}
.features-checklist,
.pricing-details {
  display: flex;
  align-items: flex-start;
  justify-content: flex-start;
  max-width: 100%;
}
.features-checklist {
  width: 1134px;
  flex-direction: row;
  padding: 0 var(--padding-11xs);
  box-sizing: border-box;
  font-size: var(--font-size-mini);
  color: var(--color-gray-100);
}
.pricing-details {
  align-self: stretch;
  flex-direction: column;
  gap: 24.6px;
  text-align: left;
  font-size: var(--font-size-xl);
  color: var(--color-darkslateblue-300);
  font-family: var(--font-montserrat);
}
.marker-shapes,
.ture-mark-01-icon,
.ture-mark-01-icon1 {
  position: absolute;
  top: 7px;
  left: 425px;
  width: 19.3px;
  height: 19.3px;
}
.marker-shapes,
.ture-mark-01-icon1 {
  top: 82px;
  left: 426px;
}
.marker-shapes {
  top: 0;
  left: 0;
  border-radius: 50%;
  background-color: var(--color-mediumseagreen);
  width: 100%;
  height: 100%;
}
.union-icon {
  position: absolute;
  top: 2.5px;
  left: 1.8px;
  width: 16.3px;
  height: 16.3px;
  object-fit: contain;
  z-index: 1;
}
.cross-mark-01,
.ture-mark-01-icon2,
.ture-mark-01-icon3 {
  position: absolute;
  top: 210px;
  left: 426px;
  width: 19.3px;
  height: 19.3px;
}
.ture-mark-01-icon2,
.ture-mark-01-icon3 {
  top: 7px;
  left: 658px;
}
.ture-mark-01-icon3 {
  top: 82px;
  left: 659px;
}
.cross-mark-01-child {
  position: absolute;
  top: 0;
  left: 0;
  border-radius: 50%;
  background-color: var(--color-mediumseagreen);
  width: 100%;
  height: 100%;
}
.union-icon1 {
  position: absolute;
  top: 2.5px;
  left: 1.8px;
  width: 16.3px;
  height: 16.3px;
  object-fit: contain;
  z-index: 1;
}
.cross-mark-011,
.ture-mark-01-icon4,
.ture-mark-01-icon5 {
  position: absolute;
  top: 210px;
  left: 659px;
  width: 19.3px;
  height: 19.3px;
}
.ture-mark-01-icon4,
.ture-mark-01-icon5 {
  top: 7px;
  left: 900px;
}
.ture-mark-01-icon5 {
  top: 82px;
  left: 901px;
}
.cross-mark-01-item {
  position: absolute;
  top: 0;
  left: 0;
  border-radius: 50%;
  background-color: var(--color-mediumseagreen);
  width: 100%;
  height: 100%;
}
.union-icon2 {
  position: absolute;
  top: 2.5px;
  left: 1.8px;
  width: 16.3px;
  height: 16.3px;
  object-fit: contain;
  z-index: 1;
}
.cross-mark-012,
.ture-mark-01-icon6,
.ture-mark-01-icon7 {
  position: absolute;
  top: 210px;
  left: 901px;
  width: 19.3px;
  height: 19.3px;
}
.ture-mark-01-icon6,
.ture-mark-01-icon7 {
  top: 7px;
  left: 1145px;
}
.ture-mark-01-icon7 {
  top: 82px;
  left: 1146px;
}
.cross-mark-01-inner {
  position: absolute;
  top: 0;
  left: 0;
  border-radius: 50%;
  background-color: var(--color-mediumseagreen);
  width: 100%;
  height: 100%;
}
.union-icon3 {
  position: absolute;
  top: 2.5px;
  left: 1.8px;
  width: 16.3px;
  height: 16.3px;
  object-fit: contain;
  z-index: 1;
}
.cross-mark-013,
.ellipse-div {
  position: absolute;
  top: 44px;
  left: 1146px;
  width: 19.3px;
  height: 19.3px;
}
.ellipse-div {
  top: 0;
  left: 0;
  border-radius: 50%;
  background-color: var(--color-mediumseagreen);
  width: 100%;
  height: 100%;
}
.union-icon4 {
  position: absolute;
  top: 2.5px;
  left: 1.8px;
  width: 16.3px;
  height: 16.3px;
  object-fit: contain;
  z-index: 1;
}
.cross-mark-014,
.line-grid-icon {
  position: absolute;
  top: 210px;
  left: 1146px;
  width: 19.3px;
  height: 19.3px;
}
.line-grid-icon {
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  z-index: 2;
}
.feature-comparison {
  width: 100%;
  height: 240px;
  position: absolute;
  margin: 0 !important;
  right: 0;
  bottom: 102px;
  left: 0;
}
.layout-01 {
  width: 100%;
  position: relative;
  box-shadow: 0 4px 4px rgba(0, 0, 0, 0.25);
  border-radius: 15px;
  background-color: var(--color-white);
  overflow: hidden;
  display: flex;
  flex-direction: column;
  align-items: flex-end;
  justify-content: flex-start;
  padding: 83px 32.1px 117.8px 30px;
  box-sizing: border-box;
  gap: 48.6px;
  line-height: normal;
  letter-spacing: normal;
}
@media screen and (max-width: 975px) {
  .compare-all-features {
    font-size: 28px;
  }
  .feature-comparison-table {
    flex-wrap: wrap;
  }
  .client-payment-steps {
    flex-wrap: wrap;
    gap: var(--gap-5xl);
  }
  .process-steps {
    gap: 16px;
  }
  .onboarding-process {
    gap: 30px;
  }
}
@media screen and (max-width: 700px) {
  .process-steps {
    min-width: 100%;
  }
  .layout-01 {
    gap: var(--gap-5xl);
  }
}
@media screen and (max-width: 450px) {
  .compare-all-features {
    font-size: 21px;
  }
  .subscription-options {
    justify-content: center;
  }
  .plan-comparison-parent {
    gap: var(--gap-lgi);
  }
  .advance,
  .lite,
  .standard {
    font-size: var(--font-size-base);
  }
  .box-03-wrapper {
    flex: 1;
  }
  .enterprise {
    font-size: var(--font-size-base);
  }
  .box-04 {
    flex: 1;
  }
  .feature-list {
    flex-wrap: wrap;
  }
}

</style>

<div class="container-fluid">
    <div class="layout-01">
      <section class="main-content">
        <div class="plan-comparison-parent">
          <div class="plan-comparison">
            <h1 class="compare-all-features">Compare all Features</h1>
          </div>
          <nav class="subscription-options">
            <div class="subscription-options-child"></div>
            <div class="text-1">
              <div class="text-1-child"></div>
              <div class="monthly">Monthly</div>
              <div class="monthly-duration-details">
                <div class="month">1 Month</div>
              </div>
            </div>
            <div class="plan-duration">
              <div class="duration-labels">
                <div class="quarterly">Quarterly</div>
                <div class="month-duration">
                  <div class="month1">3 Month</div>
                </div>
              </div>
            </div>
            <div class="plan-duration1">
              <div class="half-yearly-parent">
                <div class="half-yearly">Half Yearly</div>
                <div class="month-wrapper">
                  <div class="month2">6 Month</div>
                </div>
              </div>
            </div>
            <div class="yearly-plan-details">
              <div class="yearly-plan-content">
                <div class="yearly-wrapper">
                  <div class="yearly">Yearly</div>
                </div>
                <div class="month3">12 Month</div>
              </div>
            </div>
          </nav>
        </div>
      </section>
      <section class="pricing-details">
        <div class="plan-features">
          <div class="feature-comparison-table">
            <div class="box-01-wrapper">
              <div class="box-01">
                <div class="border"></div>
                <div class="box-01-child"></div>
                <div class="plan-features-labels">
                  <div class="plan-types">
                    <div class="lite">Lite</div>
                  </div>
                  <div class="price-details-wrapper">
                    <div class="price-details">
                      <div class="price-labels">
                        <div class="div">₹15000</div>
                        <div class="price-divider"></div>
                      </div>
                      <div class="rectangle-parent">
                        <div class="frame-child"></div>
                        <div class="save-30">Save 30%</div>
                      </div>
                    </div>
                  </div>
                  <div class="month4">
                    <span class="span">₹10,500</span>
                    <span class="month5">/month</span>
                  </div>
                </div>
                <div class="cta-wrapper">
                  <button class="cta">
                    <div class="cta-child"></div>
                    <div class="subscribe-now">Subscribe Now</div>
                  </button>
                </div>
              </div>
            </div>
            <div class="box-02">
              <div class="border1"></div>
              <div class="frame-parent">
                <div class="standard-wrapper">
                  <div class="standard">Standard</div>
                </div>
                <div class="frame-wrapper">
                  <div class="frame-group">
                    <div class="parent">
                      <div class="div1">₹20000</div>
                      <div class="button-divider"></div>
                    </div>
                    <div class="secondary-plan-button">
                      <div class="secondary-plan-button-child"></div>
                      <div class="save-301">Save 30%</div>
                    </div>
                  </div>
                </div>
                <div class="month6">
                  <span class="span1">₹14,000</span>
                  <span class="month7">/month</span>
                </div>
              </div>
              <div class="cta-container">
                <button class="cta1">
                  <div class="cta-item"></div>
                  <div class="subscribe-now1">Subscribe Now</div>
                </button>
              </div>
            </div>
            <div class="box-03-wrapper">
              <div class="box-03">
                <div class="border2"></div>
                <div class="box-03-child"></div>
                <div class="frame-container">
                  <div class="advance-wrapper">
                    <div class="advance">Advance</div>
                  </div>
                  <div class="frame-div">
                    <div class="frame-parent1">
                      <div class="group">
                        <div class="div2">₹30000</div>
                        <div class="frame-item"></div>
                      </div>
                      <div class="rectangle-group">
                        <div class="frame-inner"></div>
                        <div class="save-302">Save 30%</div>
                      </div>
                    </div>
                  </div>
                  <div class="month8">
                    <span class="span2">₹21,000</span>
                    <span class="month9">/month</span>
                  </div>
                </div>
                <div class="cta-frame">
                  <button class="cta2">
                    <div class="cta-inner"></div>
                    <div class="subscribe-now2">Subscribe Now</div>
                  </button>
                </div>
              </div>
            </div>
            <div class="box-04">
              <div class="border3"></div>
              <div class="box-04-child"></div>
              <div class="box-04-inner">
                <div class="frame-parent2">
                  <div class="enterprise-wrapper">
                    <div class="enterprise">Enterprise</div>
                  </div>
                  <div class="frame-parent3">
                    <div class="lakh-parent">
                      <div class="lakh">₹1 lakh</div>
                      <div class="line-div"></div>
                    </div>
                    <div class="savings-detail">
                      <div class="savings-detail-child"></div>
                      <div class="save-303">Save 30%</div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="month-container">
                <div class="month10">
                  <span class="span3">₹70,000</span>
                  <span class="month11">/month</span>
                </div>
              </div>
              <div class="cta-wrapper1">
                <button class="cta3">
                  <div class="rectangle-div"></div>
                  <div class="subscribe-now3">Subscribe Now</div>
                </button>
              </div>
            </div>
          </div>
        </div>
        <div class="onboarding-steps-parent">
          <div class="onboarding-steps">
            <b class="on-boarding">On Boarding</b>
            <div class="whatsapp-group-creation">Whatsapp group creation</div>
          </div>
          <div class="onboarding-process">
            <div class="process-steps">
              <div class="client-payment-steps">
                <div class="welcome-process">
                  <div class="send-welcome">
                    Send - welcome mail and 0 day report
                  </div>
                  <div class="whatsapp-group-creation1">
                    Whatsapp group creation
                  </div>
                </div>
                <div class="client-payment">
                  <div class="clients-sidepay-seperately">
                    Client’s side(Pay seperately)
                  </div>
                </div>
                <div class="client-payment1">
                  <div class="clients-sidepay-seperately1">
                    Client’s side(Pay seperately)
                  </div>
                </div>
              </div>
              <div class="business-step">
                <b class="business-understanding">Business understanding</b>
              </div>
            </div>
            <div class="additional-steps">
              <div class="clients-sidepay-seperately2">
                Client’s side(Pay seperately)
              </div>
            </div>
          </div>
        </div>
        <div class="features-checklist">
          <div class="feature-list">
            <div class="communication-channels">
              <div class="whatsapp-group-creation2">
                Whatsapp group creation
              </div>
              <div class="whatsapp-group-creation3">
                Whatsapp group creation
              </div>
            </div>
            <div class="feature-items">
              <div class="item-descriptions">1</div>
            </div>
            <div class="feature-items1">
              <div class="div3">2</div>
            </div>
            <div class="feature-items2">
              <div class="div4">3</div>
            </div>
            <div class="feature-items3">
              <div class="div5">4</div>
            </div>
          </div>
        </div>
      </section>
      <section class="feature-comparison">
        <img
          class="ture-mark-01-icon"
          loading="lazy"
          alt=""
          src="./public/ture-mark-01.svg"
        />

        <img
          class="ture-mark-01-icon1"
          loading="lazy"
          alt=""
          src="./public/ture-mark-01.svg"
        />

        <div class="cross-mark-01">
          <div class="marker-shapes"></div>
          <img
            class="union-icon"
            loading="lazy"
            alt=""
            src="./public/union@2x.png"
          />
        </div>
        <img
          class="ture-mark-01-icon2"
          loading="lazy"
          alt=""
          src="./public/ture-mark-01.svg"
        />

        <img
          class="ture-mark-01-icon3"
          loading="lazy"
          alt=""
          src="./public/ture-mark-01.svg"
        />

        <div class="cross-mark-011">
          <div class="cross-mark-01-child"></div>
          <img
            class="union-icon1"
            loading="lazy"
            alt=""
            src="./public/union@2x.png"
          />
        </div>
        <img
          class="ture-mark-01-icon4"
          loading="lazy"
          alt=""
          src="./public/ture-mark-01.svg"
        />

        <img
          class="ture-mark-01-icon5"
          loading="lazy"
          alt=""
          src="./public/ture-mark-01.svg"
        />

        <div class="cross-mark-012">
          <div class="cross-mark-01-item"></div>
          <img
            class="union-icon2"
            loading="lazy"
            alt=""
            src="./public/union@2x.png"
          />
        </div>
        <img
          class="ture-mark-01-icon6"
          loading="lazy"
          alt=""
          src="./public/ture-mark-01.svg"
        />

        <img
          class="ture-mark-01-icon7"
          loading="lazy"
          alt=""
          src="./public/ture-mark-01.svg"
        />

        <div class="cross-mark-013">
          <div class="cross-mark-01-inner"></div>
          <img
            class="union-icon3"
            loading="lazy"
            alt=""
            src="./public/union@2x.png"
          />
        </div>
        <div class="cross-mark-014">
          <div class="ellipse-div"></div>
          <img
            class="union-icon4"
            loading="lazy"
            alt=""
            src="./public/union@2x.png"
          />
        </div>
        <img class="line-grid-icon" alt="" src="./public/line-grid.svg" />
      </section>
    </div>
</div>