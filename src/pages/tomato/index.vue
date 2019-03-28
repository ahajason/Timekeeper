  <template>
    <!-- <XCircle>
        <XCircle>
            <XCircle>
              1212
            </XCircle>
        </XCircle>
    </XCircle> -->
    <DigitalClock class="DigitalClock">123</DigitalClock>
  </template>
  <script>
    import {
      XCircle
    } from 'vux';
    import DigitalClock from '@/components/common/DigitalClock';
    export default {
      name: 'tomato',
      data() {
        return {
        }
      },
      components: {
        XCircle,
        DigitalClock
      },
    }

  </script>
  <!-- Add "scoped" attribute to limit CSS to this component only -->
  <style scoped lang='less'>
    .DigitalClock{
        color: #fff;
    }
  </style>
